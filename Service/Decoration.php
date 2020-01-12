<?php

/*
 * The MIT License
 *
 * Copyright 2019 Adrien MALLET <adrien.mallet@iadinternational.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Iad\Bundle\DbDecorationBundle\Service;

use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManagerInterface;
use Iad\Bundle\DbDecorateBundle\Annotation\Decorate;
use Iad\Bundle\DbDecorateBundle\Annotation\DecoratedEntity;
use Iad\Bundle\DbDecorationBundle\Decoration\DecorationInterface;
use ReflectionClass;

/**
 * Description of DecorationService
 *
 * @author Adrien MALLET <adrien.mallet@iadinternational.com>
 */
class Decoration 
{
    protected const DEFAULT_COUNT_QUERY = 'SELECT COUNT(e) FROM %s e';

    /**
     * Doctrine entity manager
     *
     * @var EntityManangerInterface
     */
    protected $entityManager;

    /**
     * All MetadataClass of the app
     *
     * @var ClassMetadata[]
     */
    protected $metadata;

    /**
     * List of data decoration
     *
     * @var DecorationInterface
     */
    protected $decorationsChain;

    /**
     * Doctrine annotation reader
     *
     * @var Reader
     */
    protected $reader;

    public function __construct(EntityManagerInterface $em, Reader $reader)
    {
        $this->entityManager = $em;
        $this->metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $this->reader = $reader;
    }

    public function setDecorationsChain(?DecorationInterface $decorationsChain)
    {
        $this->decorationsChain = $decorationsChain; 
    }

    public function start()
    {
        foreach($this->metadata as $currentMetadata) {

            $this->decorateEntity($currentMetadata->getName(), $currentMetadata->getSingleIdentifierFieldName());
        }
    }

    protected function decorateEntity(string $className, string $identifier): void
    {
        $reflectedClass = new ReflectionClass($className);
        if (!$decorateAnnotation = $this->reader->getClassAnnotation($reflectedClass, DecoratedEntity::class)) {
            return;
        }
        
        $count = $this->em->createQuery(sprintf(static::DEFAULT_COUNT_QUERY, $className))->getSingleScalerResult();

        $annotateProperties = [];
        foreach ($reflectedClass->getProperties() as $property) {
            if (!$annotation = $this->reader->getPropertyAnnotation($property, Decorate::class)) {
                continue;
            }
            $annotateProperties[$property->getName()] = $this->decorationsChain->handleDecoration($annotation->type);
        }

        $repository = $this->entityManager->getRepository($className);
        $nbResult = ceil($count / $decorateAnnotation->limitSize);
        for($index = 0; $index < $nbResult; ++$index) {
            $result = $repository->findBy([], [$identifier => 'ASC'], $decorateAnnotation->limitSize, $index*$decorateAnnotation->limitSize);
            foreach($result as $entity) {
                foreach($annotateProperties as $propertyName => $annotateProperty) {
                    if(!property_exists($propertyName, $entity)) {
                        continue;
                    }
                    $reflectedProperty = $reflectedClass->getProperty($propertyName);
                    $reflectedProperty->setAccessible(true);
                    $reflectedProperty->{$propertyName} = $annotateProperty->decorate($reflectedProperty->{$propertyName});
                }
            }
            $this->entityManager->flush();
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}

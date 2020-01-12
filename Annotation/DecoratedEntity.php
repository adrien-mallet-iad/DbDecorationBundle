<?php

namespace Iad\Bundle\DbDecorateBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * 
 * @author Adrien MALLET <adrien.mallet@iadinternational.com>
 * 
 * @Annotation
 * @Target({"CLASS"})
 */
class DecoratedEntity
{
    private const DEFAULT_LIMIT_SIZE = 1000;

    public $limitSize = self::DEFAULT_LIMIT_SIZE;
}
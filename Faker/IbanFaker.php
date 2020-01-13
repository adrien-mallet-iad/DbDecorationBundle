<?php

namespace Iad\Bundle\DbDecorationBundle\Faker;

use Iad\Bundle\DbDecorationBundle\Annotation\Decorate;
use Iad\Bundle\DbDecorationBundle\Transformer\DecorationTransformerInterface;

class IbanFaker implements DecorateFakerInterface
{
    protected $transformer;
    
    public function __construct(DecorationTransformerInterface $transformer) 
    {
        $this->transformer = $transformer;
    }
    
    public function fake()
    {
        $data = $this->fakeIban([]);
        
        return $data;
    }

    protected function fakeIban(array $options)
    {
        return $this->transformer->transform();
    }
}
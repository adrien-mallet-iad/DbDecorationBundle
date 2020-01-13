<?php

namespace Iad\Bundle\DbDecorationBundle\Faker;

use Iad\Bundle\DbDecorationBundle\Annotation\Decorate;
use Iad\Bundle\DbDecorationBundle\Transformer\DecorationTransformerInterface;

interface DecorateFakerInterface
{
    public function __construct(DecorationTransformerInterface $transformer);
    public function fake();
}
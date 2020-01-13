<?php

namespace Iad\Bundle\DbDecorationBundle\Faker;

use Iad\Bundle\DbDecorationBundle\Annotation\Decorate;

abstract class AbstractFaker implements DecorateFakerInterface
{
    abstract public function fake();
}
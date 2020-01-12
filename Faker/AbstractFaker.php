<?php

namespace Iad\Bundle\DbDecorationBundle\Faker;

use Iad\Bundle\DbDecorateBundle\Annotation\Decorate;

abstract class AbstractFaker implements DecorateFakerInterface
{
    abstract public function fake(Decorate $decorate);
}
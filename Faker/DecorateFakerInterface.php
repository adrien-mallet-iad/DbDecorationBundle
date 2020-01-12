<?php

namespace Iad\Bundle\DbDecorationBundle\Faker;

use Iad\Bundle\DbDecorateBundle\Annotation\Decorate;

interface DecorateFakerInterface
{
    public function fake(Decorate $decorate);
}
<?php

namespace Iad\Bundle\DbDecorationBundle\Faker;

class IbanFaker implements DecorateFakerInterface
{
    public function fake()
    {
        $data = $this->fakeIban([]);
        return $data;
    }

    protected function fakeIban(array $options)
    {
        return 'FRiad3445667097847365685746';
    }
}
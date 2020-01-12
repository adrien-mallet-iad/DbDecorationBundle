<?php

namespace Iad\Bundle\DbDecorationBundle\Tests\DataFixtures;

use Iad\Bundle\DbDecorationBundle\Tests\Entity\VictoriousKangaroo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VictoriousKangarooFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 VictoriousKangaroo
        for ($i = 0; $i < 20; $i++) {
            $kangaroo = new VictoriousKangaroo();
            $kangaroo->setName('Kangaroo number #'.$i);
            $kangaroo->setIban('FR REAL IBAN #00000'.$i);
            $kangaroo->setEmail(mt_rand(10, 100));
            $kangaroo->setPhone(sprintf('01000000%2i', $i));
            $kangaroo->setMobile(sprintf('06000000%2i', $i));

            $manager->persist($kangaroo);
        }

        $manager->flush();
    }
}

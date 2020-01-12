<?php

namespace Iad\Bundle\DbDecorationBundle\Tests\App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Iad\Bundle\DbDecorationBundle\Tests\App\Entity\VictoriousKangaroo;

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

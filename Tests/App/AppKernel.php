<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Iad\Bundle\DbDecorationBundle\Tests\App;

use Iad\Bundle\DbDecorationBundle\DbDecorationBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Description of AppKernel
 *
 * @author noobu
 */
class AppKernel extends Kernel {
    //put your code here
    public function registerBundles() {
        return [
          new FrameworkBundle(),
          new DbDecorationBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__.'/config/config.yml');
    }

}

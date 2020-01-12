<?php

namespace Iad\Bundle\DbDecorationBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DbDecorationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        
        $config = $this->processConfiguration(new DbDecorationConfiguration(), $configs);
        
        $this->loadDecoration($container);
    }

    protected function loadDecoration(ContainerBuilder $container)
    {
        if (!$container->has('iad.bundle.service.decoration')) {
            return;
        }

        $decorationService = $container->getDefinition('iad.bundle.service.decoration');

        $decorations = $container->findTaggedServiceIds('iad.data.decoration');
        $currentDecorationRef = null;
        foreach($decorations as $id => $decoration) {
            $decorationRef = new Reference($id);
            if ($currentDecorationRef) {

            }
            $currentDecorationRef = $decorationRef;
        } 

        $decorationService->addMethodCall('setDecorationChains', [$currentDecorationRef]);
    }
}

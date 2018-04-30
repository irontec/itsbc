<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use AppBundle\Event\Dispatcher;


class LifecycleCompiler implements CompilerPassInterface{

    /**
     * @var ContainerBuilder
     */
    protected $container;

    public function process(ContainerBuilder $container)
    {

        $this->container = $container;

        //check if the primary service is defined
        if (!$this->container->has(Dispatcher::class)) {
            return;
        }

        $definition = $this->container->findDefinition(Dispatcher::class);

        // find all service IDs 
        $taggedServices = $this->container->findTaggedServiceIds('sbc.opensips.service');

        foreach ($taggedServices as $id => $tags) {

            // add the transport service to the ChainTransport service
            $definition->addMethodCall('addListener', array(new Reference($id), 'sbc.opensips.service'));

        }
    }

}


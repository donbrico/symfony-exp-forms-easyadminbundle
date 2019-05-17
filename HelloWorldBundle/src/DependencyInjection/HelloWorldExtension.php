<?php

namespace HelloWorld\DependencyInjection;

use ProxyManager\FileLocator\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class HelloWorldExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container,
            new \Symfony\Component\Config\FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }
}

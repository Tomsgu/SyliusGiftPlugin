<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class TomsguSyliusGiftExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        /**
         * @psalm-suppress PossiblyNullArgument
         */
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));

        $loader->load('services.xml');

        $this->registerResources('tomsgu_sylius_gift', $config['driver'], $config['resources'], $container);
    }

    public function prepend(ContainerBuilder $container): void
    {
        $container->prependExtensionConfig('framework', [
            'validation' => [
                'mapping' => [
                    'paths' => [__DIR__ . '/../../config/validation'],
                ],
            ],
        ]);
    }
}

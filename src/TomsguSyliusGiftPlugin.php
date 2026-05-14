<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

final class TomsguSyliusGiftPlugin extends AbstractResourceBundle
{
    use SyliusPluginTrait;

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getSupportedDrivers(): array
    {
        return [
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
    }

    protected function getConfigFilesPath(): string
    {
        return sprintf(
            '%s/config/doctrine/%s',
            $this->getPath(),
            strtolower($this->getDoctrineMappingDirectory()),
        );
    }
}

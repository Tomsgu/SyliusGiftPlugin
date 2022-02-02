<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Tomsgu\SyliusGiftPlugin\DependencyInjection\TomsguSyliusGiftExtension;

class TomsguSyliusGiftExtensionSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(TomsguSyliusGiftExtension::class);
    }

    function it_is_extending_abstract_resource_extension(): void
    {
        $this->shouldHaveType(AbstractResourceExtension::class);
    }
}

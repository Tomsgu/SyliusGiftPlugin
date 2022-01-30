<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Tomsgu\SyliusGiftPlugin\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(Configuration::class);
    }

    function it_returns_tree_builder(): void
    {
        $this->getConfigTreeBuilder()->shouldBeAnInstanceOf(TreeBuilder::class);
    }

    function it_has_default_driver_configured(): void
    {
        $builder = $this->getConfigTreeBuilder()->buildTree();
        $builder->getName()->shouldBe('tomsgu_sylius_gift');
        $builder->getChildren()['driver']->getDefaultValue()->shouldBe(SyliusResourceBundle::DRIVER_DOCTRINE_ORM);
        $builder->getChildren()['resources']->getDefaultValue()->shouldBeArray();
    }
}

<?php

namespace spec\Tomsgu\SyliusGiftPlugin\Menu;

use Knp\Menu\ItemInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Tomsgu\SyliusGiftPlugin\Menu\AdminMenuListener;

class AdminMenuListenerSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(AdminMenuListener::class);
    }

    function it_builds_menu(
        MenuBuilderEvent $menuBuilderEvent,
        ItemInterface $menu,
        ItemInterface $configMenu
    ): void {
        $menuBuilderEvent->getMenu()->willReturn($menu);
        $menu->getChild('configuration')->willReturn($configMenu);
        $configMenu->addChild('gift_option', [
            'route' => 'tomsgu_sylius_gift_admin_gift_option_index',
        ])->willReturn($configMenu);
        $configMenu->setLabel('tomsgu_sylius_gift.menu.gift_option')->willReturn($configMenu);
        $configMenu->setLabelAttribute('icon', 'gift')->shouldBeCalled();

        $this->buildMenu($menuBuilderEvent);
    }
}

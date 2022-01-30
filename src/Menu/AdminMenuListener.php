<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function buildMenu(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
//        $header = $this->getHeader($menu);

        $header = $menu->getChild('configuration');

        if (null === $header) {
            throw new \RuntimeException('No header found with key `configuration`');
        }

        $header
            ->addChild('gift_option', [
                'route' => 'tomsgu_sylius_gift_admin_gift_option_index',
            ])
            ->setLabel('tomsgu_sylius_gift.menu.gift_option')
            ->setLabelAttribute('icon', 'gift');
    }

    private function getHeader(ItemInterface $menu): ItemInterface
    {
        $header = $menu->getChild('configuration');

        if (null === $header) {
            throw new \RuntimeException('No header found with key `configuration`');
        }

        return $header;
    }
}

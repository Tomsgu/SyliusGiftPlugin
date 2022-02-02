<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Shop;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

class CompletePage extends SymfonyPage implements CompletePageInterface
{
    public function checkGiftCheckbox(): void
    {
        $this->getDocument()->checkField('sylius_checkout_complete_gift_option');
    }

    public function getRouteName(): string
    {
        return 'sylius_shop_checkout_complete';
    }
}

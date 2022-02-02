<?php

declare(strict_types=1);


namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Shop;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;

interface CompletePageInterface extends SymfonyPageInterface
{
    public function checkGiftCheckbox(): void;
}

<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption;

use Sylius\Behat\Page\Admin\Crud\IndexPageInterface as BaseIndexPageInterface;

//use Tests\Tomsgu\SyliusGiftPlugin\Behat\Behaviour\ContainsEmptyListInterface;

interface IndexPageInterface extends BaseIndexPageInterface //, ContainsEmptyListInterface
{
    public function deleteGiftOption(string $label): void;

    public function isEmpty(): bool;
}

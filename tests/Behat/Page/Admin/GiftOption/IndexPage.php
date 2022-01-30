<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;

class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    public function deleteGiftOption(string $label): void
    {
        $this->deleteResourceOnPage(['label' => $label]);
    }

    public function isEmpty(): bool
    {
        /** @var NodeElement $messageElem */
        $messageElem = $this->getDocument()->find('css', '.message');

        return str_contains($messageElem->getText(), 'There are no results to display');
    }
}

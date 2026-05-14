<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\Order;

use Sylius\Behat\Page\Admin\Order\ShowPage as BaseShowPage;

class ShowPage extends BaseShowPage implements ShowPageInterface
{
    public function hasNoteElement(): bool
    {
        if (!$this->hasElement('notes')) {
            return false;
        }

        $text = trim($this->getElement('notes')->getText());

        return $text !== '' && $text !== '-';
    }
}

<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption;

use Sylius\Behat\Page\Admin\Crud\UpdatePage as BaseUpdatePage;

class UpdatePage extends BaseUpdatePage implements UpdatePageInterface
{
    public function fillLabel(string $value): void
    {
        $this->getDocument()->fillField('Gift checkbox label', $value);
    }

    public function fillNotes(string $value): void
    {
        $this->getDocument()->fillField('Note to be added to an order', $value);
    }
}

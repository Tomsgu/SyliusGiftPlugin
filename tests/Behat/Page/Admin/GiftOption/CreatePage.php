<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption;

use Sylius\Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;

class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    public function fillLabel(string $value): void
    {
        $this->getDocument()->fillField('Gift checkbox label', $value);
    }

    public function fillNotes(string $value): void
    {
        $this->getDocument()->fillField('Note to be added to an order', $value);
    }

    public function containsErrorWithMessage(string $message, bool $strict = true): bool
    {
        $validationMessageElements = $this->getDocument()->findAll('css', '.sylius-validation-error');

        foreach ($validationMessageElements as $validationMessageElement) {
            if (true === $strict && $message === $validationMessageElement->getText()) {
                return true;
            }

            if (false === $strict && str_contains($validationMessageElement->getText(), $message)) {
                return true;
            }
        }

        return false;
    }
}

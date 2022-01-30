<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption;

use Sylius\Behat\Page\Admin\Crud\CreatePageInterface as BaseCreatePageInterface;

interface CreatePageInterface extends BaseCreatePageInterface
{
    public function fillLabel(string $value): void;

    public function fillNotes(string $value): void;

    public function containsErrorWithMessage(string $message, bool $strict = true): bool;
}

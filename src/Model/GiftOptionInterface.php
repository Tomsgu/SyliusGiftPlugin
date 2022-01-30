<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Model;

use Sylius\Component\Channel\Model\ChannelAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface GiftOptionInterface extends ResourceInterface, ChannelAwareInterface, TranslatableInterface, TimestampableInterface
{
    public function getLabel(): string;

    public function setLabel(string $label): void;

    public function getOrderNote(): string;

    public function setOrderNote(string $note): void;

    public function isEnabled(): bool;

    public function setEnabled(bool $enabled): void;

    public function enable(): void;

    public function disable(): void;

    /**
     * @return GiftOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}

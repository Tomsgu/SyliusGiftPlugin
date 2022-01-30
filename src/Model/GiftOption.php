<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Model;

use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

class GiftOption implements GiftOptionInterface
{
    use TimestampableTrait;
    use ToggleableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;

        getTranslation as private doGetTranslation;
    }

    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->enabled = false;
        $this->orderNote = '';
    }

    /** @psalm-suppress PropertyNotSetInConstructor */
    protected ?int $id;

    protected string $orderNote;

    /** @psalm-suppress PropertyNotSetInConstructor */
    protected ?ChannelInterface $channel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setOrderNote(string $note): void
    {
        $this->orderNote = $note;
    }

    public function getOrderNote(): string
    {
        return $this->orderNote;
    }

    public function getLabel(): string
    {
        return $this->getTranslation()->getLabel();
    }

    public function setLabel(string $label): void
    {
        $this->getTranslation()->setLabel($label);
    }

    public function getChannel(): ?ChannelInterface
    {
        return $this->channel;
    }

    public function setChannel(?ChannelInterface $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return GiftOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var GiftOptionTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    protected function createTranslation(): GiftOptionTranslationInterface
    {
        return new GiftOptionTranslation();
    }
}

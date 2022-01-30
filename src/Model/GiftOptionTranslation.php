<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Model;

use Sylius\Component\Resource\Model\AbstractTranslation;

class GiftOptionTranslation extends AbstractTranslation implements GiftOptionTranslationInterface
{
    protected mixed $id;

    protected string $label;

    public function __construct()
    {
        $this->label = '';
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }
}

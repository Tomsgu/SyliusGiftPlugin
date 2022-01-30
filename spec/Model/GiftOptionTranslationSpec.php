<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\Model;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionTranslation;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionTranslationInterface;

class GiftOptionTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GiftOptionTranslation::class);
    }

    function it_is_a_resource(): void
    {
        $this->shouldHaveType(ResourceInterface::class);
    }

    function it_implements_block_interface(): void
    {
        $this->shouldHaveType(GiftOptionTranslationInterface::class);
        $this->shouldHaveType(TranslationInterface::class);
    }

    function it_initialize_fields(): void
    {
        $this->getLabel()->shouldReturn('');
    }

    function it_allows_access_via_properties(): void
    {
        $this->setLabel('Test label');
        $this->getLabel()->shouldReturn('Test label');
    }
}

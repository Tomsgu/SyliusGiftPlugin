<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\Model;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOption;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;

class GiftOptionSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(GiftOption::class);
    }

    function it_is_a_resource(): void
    {
        $this->shouldHaveType(ResourceInterface::class);
    }

    function it_implements_block_interface(): void
    {
        $this->shouldHaveType(GiftOptionInterface::class);
    }

    function it_initialize_fields(): void
    {
        $this->getOrderNote()->shouldReturn('');
        $this->isEnabled()->shouldReturn(false);
    }

    function it_toggles(): void
    {
        $this->enable();
        $this->isEnabled()->shouldReturn(true);

        $this->disable();
        $this->isEnabled()->shouldReturn(false);
    }

    function it_sets_order_note(): void
    {
        $this->setOrderNote('Test note.');
        $this->getOrderNote()->shouldReturn('Test note.');
    }

    function it_sets_channel(ChannelInterface $channel): void
    {
        $this->setChannel($channel);
        $this->getChannel()->shouldReturn($channel);

        $this->setChannel(null);
        $this->getChannel()->shouldReturn(null);
    }

    function it_is_timestampable(): void
    {
        $dateTime = new \DateTime();

        $this->setCreatedAt($dateTime);
        $this->getCreatedAt()->shouldReturn($dateTime);

        $this->setUpdatedAt($dateTime);
        $this->getUpdatedAt()->shouldReturn($dateTime);
    }
}

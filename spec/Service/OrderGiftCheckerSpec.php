<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\Service;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Tomsgu\SyliusGiftPlugin\Doctrine\ORM\GiftOptionRepositoryInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;
use Tomsgu\SyliusGiftPlugin\Service\OrderGiftChecker;
use Tomsgu\SyliusGiftPlugin\Service\OrderGiftCheckerInterface;

class OrderGiftCheckerSpec extends ObjectBehavior
{
    function let(GiftOptionRepositoryInterface $repository): void
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(OrderGiftChecker::class);
    }

    function it_implements_order_gift_checker_interface(): void
    {
        $this->shouldHaveType(OrderGiftCheckerInterface::class);
    }

    function it_decide_if_order_is_a_gift(
        OrderInterface $order,
        ChannelInterface $channel,
        GiftOptionInterface $giftOption,
        GiftOptionRepositoryInterface $repository
    ): void {
        $this->beConstructedWith($repository);
        $order->getChannel()->willReturn($channel);
        $repository->findByChannel($channel)->willReturn($giftOption);
        $order->getNotes()->willReturn('GIFT\r\nAnother note');
        $giftOption->getOrderNote()->willReturn('GIFT');
        $this->isOrderGift($order)->shouldReturn(true);
    }

    function it_returns_decide_false_if_order_is_a_gift(
        OrderInterface $order,
        ChannelInterface $channel,
        GiftOptionInterface $giftOption,
        GiftOptionRepositoryInterface $repository
    ): void {
        $this->beConstructedWith($repository);
        $order->getChannel()->willReturn($channel);
        $repository->findByChannel($channel)->willReturn($giftOption);
        $order->getNotes()->willReturn('Another note');
        $giftOption->getOrderNote()->willReturn('GIFT');
        $this->isOrderGift($order)->shouldReturn(false);
    }
}

<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\Service;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Order\Model\Order;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;
use Tomsgu\SyliusGiftPlugin\Service\GiftOptionContextInterface;
use Tomsgu\SyliusGiftPlugin\Service\OrderGiftNoteManager;
use Tomsgu\SyliusGiftPlugin\Service\OrderGiftNoteManagerInterface;
use Webmozart\Assert\Assert;

class OrderGiftNoteManagerSpec extends ObjectBehavior
{
    function let(GiftOptionContextInterface $giftOptionContext): void
    {
        $this->beConstructedWith($giftOptionContext);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OrderGiftNoteManager::class);
    }

    function it_implements_order_gift_note_manager_interface(): void
    {
        $this->shouldHaveType(OrderGiftNoteManagerInterface::class);
    }

    function it_does_nothing_if_gift_option_is_not_enabled(
        GiftOptionContextInterface $giftOptionContext,
        OrderInterface $order
    ): void {
        $this->beConstructedWith($giftOptionContext, $order);
        $giftOptionContext->getGiftOption()->willReturn(null);

        $order->getNotes()->shouldNotBeCalled();
        $this->addGiftNote($order);
    }

    function it_adds_gift_notes_if_order_has_a_comment(
        GiftOptionInterface $giftOption,
        GiftOptionContextInterface $giftOptionContext
    ): void {
        $giftOptionContext->getGiftOption()->willReturn($giftOption);
        $giftOption->isEnabled()->willReturn(true);
        $giftOption->getOrderNote()->willReturn('GIFT');

        $order = new Order();
        $order->setNotes('something');
        $this->addGiftNote($order);

        Assert::eq('GIFT'.PHP_EOL.PHP_EOL.'something', $order->getNotes());
    }

    function it_adds_gift_notes_if_order_has_no_comment(
        GiftOptionInterface $giftOption,
        GiftOptionContextInterface $giftOptionContext
    ): void {
        $giftOptionContext->getGiftOption()->willReturn($giftOption);
        $giftOption->isEnabled()->willReturn(true);
        $giftOption->getOrderNote()->willReturn('GIFT');

        $order = new Order();
        $order->setNotes(null);
        $this->addGiftNote($order);

        Assert::eq('GIFT', $order->getNotes());
    }
}

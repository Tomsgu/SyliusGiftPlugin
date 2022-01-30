<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\Listener;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\Order;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Tomsgu\SyliusGiftPlugin\Listener\AddGiftComment;
use Tomsgu\SyliusGiftPlugin\Model\GiftOption;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;
use Tomsgu\SyliusGiftPlugin\Service\GiftOptionContextInterface;
use Webmozart\Assert\Assert;

class AddGiftCommentSpec extends ObjectBehavior
{
    function let(RequestStack $requestStack, GiftOptionContextInterface $giftOptionContext): void
    {
        $this->beConstructedWith($requestStack, $giftOptionContext);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(AddGiftComment::class);
    }

    function it_is_implementing_event_subscriber_interface(): void
    {
        $this->shouldHaveType(EventSubscriberInterface::class);
    }

    function it_does_nothing_if_gift_is_not_checked(
        RequestStack $requestStack,
        Request $request,
        ResourceControllerEvent $event
    ): void {
        $requestStack->getCurrentRequest()->willReturn($request);
        $request->request = new InputBag();
        $event->getSubject()->shouldNotHaveBeenCalled();
        $this->addNote($event);
    }

    function it_does_nothing_if_gift_option_is_not_enabled(
        RequestStack $requestStack,
        GiftOptionContextInterface $giftOptionContext,
        Request $request,
        ResourceControllerEvent $event
    ): void {
        $this->beConstructedWith($requestStack, $giftOptionContext);
        $requestStack->getCurrentRequest()->willReturn($request);
        $request->request = new InputBag(['sylius_checkout_complete' => ['gift_option' => true]]);
        $giftOptionContext->getGiftOption()->willReturn(null);

        $event->getSubject()->shouldNotBeCalled();
        $this->addNote($event);
    }

    function it_adds_gift_notes_if_order_has_a_comment(
        RequestStack $requestStack,
        Request $request,
        ResourceControllerEvent $event,
        GiftOptionInterface $giftOption,
        GiftOptionContextInterface $giftOptionContext
    ): void {
        $requestStack->getCurrentRequest()->willReturn($request);
        $request->request = new InputBag(['sylius_checkout_complete' => ['gift_option' => true]]);

        $giftOption->isEnabled()->willReturn(true);

        $order = new Order();
        $order->setNotes('something');
        $event->getSubject()->willReturn($order);
        $giftOption->getOrderNote()->willReturn('GIFT');
        $giftOptionContext->getGiftOption()->willReturn($giftOption);
        $this->addNote(new ResourceControllerEvent($order));

        Assert::eq('GIFT'.PHP_EOL.PHP_EOL.'something', $order->getNotes());
    }

    function it_adds_gift_notes_if_order_has_no_comment(
        RequestStack $requestStack,
        Request $request,
        ResourceControllerEvent $event,
        GiftOptionInterface $giftOption,
        GiftOptionContextInterface $giftOptionContext
    ): void {
        $requestStack->getCurrentRequest()->willReturn($request);
        $request->request = new InputBag(['sylius_checkout_complete' => ['gift_option' => true]]);
        $giftOption->isEnabled()->willReturn(true);
        $order = new Order();
        $order->setNotes(null);
        $event->getSubject()->willReturn($order);
        $giftOption->getOrderNote()->willReturn('GIFT');
        $giftOptionContext->getGiftOption()->willReturn($giftOption);
        $this->addNote(new ResourceControllerEvent($order));

        Assert::eq('GIFT', $order->getNotes());
    }
}

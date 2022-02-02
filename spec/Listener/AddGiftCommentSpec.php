<?php

declare(strict_types=1);

namespace spec\Tomsgu\SyliusGiftPlugin\Listener;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\Order;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Tomsgu\SyliusGiftPlugin\Listener\AddGiftComment;
use Tomsgu\SyliusGiftPlugin\Service\OrderGiftNoteManagerInterface;

class AddGiftCommentSpec extends ObjectBehavior
{
    function let(
        RequestStack $requestStack,
        OrderGiftNoteManagerInterface $orderGiftNoteManager
    ): void {
        $this->beConstructedWith($requestStack, $orderGiftNoteManager);
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
        ResourceControllerEvent $event,
        OrderGiftNoteManagerInterface $orderGiftNoteManager
    ): void {
        $requestStack->getCurrentRequest()->willReturn($request);
        $request->request = new InputBag();
        $event->getSubject()->shouldNotHaveBeenCalled();
        $this->addNote($event);
    }

    function it_adds_notes(
        RequestStack $requestStack,
        Request $request,
        ResourceControllerEvent $event,
        OrderGiftNoteManagerInterface $orderGiftNoteManager

    ): void {
        $requestStack->getCurrentRequest()->willReturn($request);
        $request->request = new InputBag(['sylius_checkout_complete' => ['gift_option' => true]]);

        $order = new Order();
        $event->getSubject()->willReturn($order);
        $orderGiftNoteManager->addGiftNote($order)->shouldBeCalled();

        $this->addNote($event);
    }
}

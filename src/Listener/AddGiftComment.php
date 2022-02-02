<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Listener;

use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Order\Model\OrderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Tomsgu\SyliusGiftPlugin\Service\OrderGiftNoteManagerInterface;

final class AddGiftComment implements EventSubscriberInterface
{
    public function __construct(
        private RequestStack $requestStack,
        private OrderGiftNoteManagerInterface $orderGiftNoteManager
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.order.pre_complete' => 'addNote',
        ];
    }

    public function addNote(ResourceControllerEvent $event): void
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $formData = $request->request->all('sylius_checkout_complete');
        if (array_key_exists('gift_option', $formData) === false) {
            return;
        }

        /** @var OrderInterface $order */
        $order = $event->getSubject();
        $this->orderGiftNoteManager->addGiftNote($order);
    }
}

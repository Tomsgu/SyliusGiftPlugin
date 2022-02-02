<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Service;

use Sylius\Component\Order\Model\OrderInterface;

class OrderGiftNoteManager implements OrderGiftNoteManagerInterface
{
    public function __construct(private GiftOptionContextInterface $giftOptionContext)
    {
    }

    public function addGiftNote(OrderInterface $order): void
    {
        $giftOption = $this->giftOptionContext->getGiftOption();
        if ($giftOption === null || $giftOption->isEnabled() === false) {
            return;
        }

        $note = $order->getNotes();
        if ($note !== null && trim($note) !== '') {
            $notes = sprintf(
                '%s%s%s%s',
                $giftOption->getOrderNote(),
                \PHP_EOL,
                \PHP_EOL,
                $note
            );
        } else {
            $notes = $giftOption->getOrderNote();
        }

        $order->setNotes($notes);
    }
}

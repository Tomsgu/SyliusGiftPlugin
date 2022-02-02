<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Service;

use Sylius\Component\Order\Model\OrderInterface;

interface OrderGiftNoteManagerInterface
{
    public function addGiftNote(OrderInterface $order): void;
}

<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Service;

use Sylius\Component\Core\Model\OrderInterface;

interface OrderGiftCheckerInterface
{
    public function isOrderGift(OrderInterface $order): bool;
}

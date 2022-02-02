<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Service;

use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Tomsgu\SyliusGiftPlugin\Doctrine\ORM\GiftOptionRepositoryInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;

class OrderGiftChecker implements OrderGiftCheckerInterface
{
    public function __construct(private GiftOptionRepositoryInterface $giftOptionRepository)
    {
    }

    public function isOrderGift(OrderInterface $order): bool
    {
        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();
        /** @var GiftOptionInterface $giftOption */
        $giftOption = $this->giftOptionRepository->findByChannel($channel);

        return str_contains($order->getNotes() ?? '', $giftOption->getOrderNote()) === true;
    }
}

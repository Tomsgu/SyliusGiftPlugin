<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Service;

use Sylius\Component\Channel\Context\ChannelContextInterface;
use Tomsgu\SyliusGiftPlugin\Doctrine\ORM\GiftOptionRepositoryInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;

final class GiftOptionContext implements GiftOptionContextInterface
{
    public function __construct(
        private ChannelContextInterface $channelContext,
        private GiftOptionRepositoryInterface $giftOptionRepository
    ) {
    }

    public function getGiftOption(): ?GiftOptionInterface
    {
        $channel = $this->channelContext->getChannel();

        return $this->giftOptionRepository->findByChannel($channel);
    }
}

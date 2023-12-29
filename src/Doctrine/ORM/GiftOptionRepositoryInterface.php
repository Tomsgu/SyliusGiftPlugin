<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Doctrine\ORM;

use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;

/**
 * @extends RepositoryInterface<GiftOptionInterface>
 */
interface GiftOptionRepositoryInterface extends RepositoryInterface
{
    public function findByChannel(ChannelInterface $channel): ?GiftOptionInterface;
}

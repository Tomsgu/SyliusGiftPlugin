<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Model\ChannelInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;

class GiftOptionRepository extends EntityRepository implements GiftOptionRepositoryInterface
{
    public function findByChannel(ChannelInterface $channel): ?GiftOptionInterface
    {
        /** @var GiftOptionInterface $giftOption */
        $giftOption = $this->findOneBy(['channel' => $channel]);

        return $giftOption;
    }
}

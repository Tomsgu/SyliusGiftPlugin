<?php

declare(strict_types=1);

namespace Tomsgu\SyliusGiftPlugin\Service;

use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;

interface GiftOptionContextInterface
{
    public function getGiftOption(): ?GiftOptionInterface;
}

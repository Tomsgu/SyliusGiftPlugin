<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Tomsgu\SyliusGiftPlugin\Doctrine\ORM\GiftOptionRepositoryInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOption;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;

class GiftOptionContext implements Context
{
    public function __construct(
        private SharedStorageInterface $sharedStorage,
        private GiftOptionRepositoryInterface $giftOptionRepository
    ) {
    }

    /**
     * @Given there is a gift option in the store
     */
    public function thereIsAGiftOptionInTheStore(): void
    {
        $giftOption = $this->createGiftOption();

        $this->saveGiftOption($giftOption);
    }

    private function createGiftOption(): GiftOptionInterface
    {
        $giftOption = new GiftOption();
        $giftOption->setCurrentLocale('en_US');

        if ($this->sharedStorage->has('channel')) {
            /** @var ChannelInterface $channel */
            $channel = $this->sharedStorage->get('channel');
            $giftOption->setChannel($channel);
        }

        $giftOption->setLabel('This order is a gift for somebody else. Invoice is not sent in a package.');
        $giftOption->setOrderNote('GIFT - don\'t send invoice');
        $giftOption->setEnabled(true);

        return $giftOption;
    }

    private function saveGiftOption(GiftOptionInterface $giftOption): void
    {
        $this->giftOptionRepository->add($giftOption);
        $this->sharedStorage->set('gift-option', $giftOption);
    }
}

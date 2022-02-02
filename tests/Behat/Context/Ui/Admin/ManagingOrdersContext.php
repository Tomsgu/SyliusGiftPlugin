<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Sylius\Behat\Service\SharedSecurityServiceInterface;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\Order\ShowPageInterface;
use Tomsgu\SyliusGiftPlugin\Model\GiftOption;
use Webmozart\Assert\Assert;

class ManagingOrdersContext implements Context
{
    public function __construct(
        private ShowPageInterface $showPage,
        private SharedSecurityServiceInterface $sharedSecurityService,
        private SharedStorageInterface $sharedStorage
    ) {
    }

    /**
     * @Then /^(the administrator) should see that (order placed by "[^"]+") has a gift note$/
     */
    public function theAdministratorShouldSeeThatThisOrderHasGiftNote(
        AdminUserInterface $user,
        OrderInterface $order
    ): void {
        /** @var GiftOption $giftOption */
        $giftOption = $this->sharedStorage->get('gift-option');
        $giftNote = $giftOption->getOrderNote();

        if ($this->sharedStorage->has('additional_note') === true) {
            /** @var string $orderNote */
            $orderNote = $this->sharedStorage->get('additional_note');
            $note = sprintf('%s %s', $giftNote, $orderNote);
        } else {
            $note = $giftNote;
        }

        $this->sharedSecurityService->performActionAsAdminUser(
            $user,
            function () use ($order, $note) {
                $this->showPage->open(['id' => $order->getId()]);

                Assert::true($this->showPage->hasNote($note));
            }
        );
    }

    /**
     * @Then /^(the administrator) should see that (order placed by "[^"]+") has no note$/
     */
    public function theAdministratorShouldSeeThatThisOrderHasNoNote(
        AdminUserInterface $user,
        OrderInterface $order
    ): void {
        $this->sharedSecurityService->performActionAsAdminUser($user, function () use ($order) {
            $this->showPage->open(['id' => $order->getId()]);

            Assert::false($this->showPage->hasNoteElement());
        });
    }
}

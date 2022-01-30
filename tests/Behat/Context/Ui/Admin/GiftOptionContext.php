<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Sylius\Behat\NotificationType;
use Sylius\Behat\Service\NotificationCheckerInterface;
use Sylius\Behat\Service\Resolver\CurrentPageResolverInterface;
use Sylius\Behat\Service\SharedStorageInterface;
use Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption\CreatePage;
use Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption\IndexPage;
use Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Admin\GiftOption\UpdatePage;
use Tomsgu\SyliusGiftPlugin\Model\GiftOptionInterface;
use Webmozart\Assert\Assert;

class GiftOptionContext implements Context
{
    public function __construct(
        private SharedStorageInterface $sharedStorage,
        private IndexPage $indexPage,
        private UpdatePage $updatePage,
        private CreatePage $createPage,
        private NotificationCheckerInterface $notificationChecker
    ) {
    }

    /**
     * @When I go to the gift options page
     */
    public function iGoToTheGiftOptionsPage(): void
    {
        $this->indexPage->open();
    }

    /**
     * @When I delete this gift option
     */
    public function iDeleteThisGiftOption(): void
    {
        /** @var GiftOptionInterface $giftOption */
        $giftOption = $this->sharedStorage->get('gift-option');

        $this->indexPage->deleteGiftOption($giftOption->getLabel());
    }

    /**
     * @Then I should be notified that the gift option has been deleted
     */
    public function iShouldBeNotifiedThatTheGiftOptionHasBeenDeleted(): void
    {
        $this->notificationChecker->checkNotification(
            'Gift option has been successfully deleted.',
            NotificationType::success()
        );
    }

    /**
     * @Then I should see empty list of gift options
     */
    public function iShouldSeeEmptyListOfGiftOptions(): void
    {
        $this->indexPage->isEmpty();
    }

    /**
     * @When I want to edit this gift option
     */
    public function iWantToEditThisGiftOption(): void
    {
        /** @var GiftOptionInterface $giftOption */
        $giftOption = $this->sharedStorage->get('gift-option');

        $this->updatePage->open(['id' => $giftOption->getId()]);
    }

    /**
     * @When I want to add a new gift option
     */
    public function iWantToAddANewGiftOption(): void
    {
        $this->createPage->open();
    }

    /**
     * @When I change its label to :value
     */
    public function iChangeItsLabelTo(string $value): void
    {
        $this->updatePage->fillLabel($value);

        $this->sharedStorage->set('gift_option_label', $value);
    }

    /**
     * @When I change its note to :value
     */
    public function iChangeItsNotesTo(string $value): void
    {
        $this->updatePage->fillNotes($value);

        $this->sharedStorage->set('gift_option_note', $value);
    }

    /**
     * @When I fill its label to :value
     */
    public function iFillItsLabelTo(string $value): void
    {
        $this->createPage->fillLabel($value);

        $this->sharedStorage->set('gift_option_label', $value);
    }

    /**
     * @When I fill its note to :value
     */
    public function iFillItsNotesTo(string $value): void
    {
        $this->createPage->fillNotes($value);

        $this->sharedStorage->set('gift_option_note', $value);
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges(): void
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @When I submit the form
     */
    public function iSubmitTheForm(): void
    {
        $this->createPage->create();
    }

    /**
     * @Then I should be notified that the gift option was updated
     */
    public function iShouldBeNotifiedThatTheGiftOptionWasUpdated(): void
    {
        $this->notificationChecker->checkNotification(
            'Gift option has been successfully updated.',
            NotificationType::success()
        );
    }

    /**
     * @Then I should be notified that the gift option was added
     */
    public function iShouldBeNotifiedThatTheGiftOptionWasAdded(): void
    {
        $this->notificationChecker->checkNotification(
            'Gift option has been successfully created.',
            NotificationType::success()
        );
    }

    /**
     * @Then I should be notified that :fields fields cannot be blank
     */
    public function iShouldBeNotifiedThatFieldsCannotBeBlank(string $fields): void
    {
        $fields = explode(',', $fields);

        foreach ($fields as $field) {
            Assert::true($this->createPage->containsErrorWithMessage(sprintf(
                '%s cannot be blank.',
                trim($field)
            )));
        }
    }
}

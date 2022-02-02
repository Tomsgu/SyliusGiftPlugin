<?php

declare(strict_types=1);

namespace Tests\Tomsgu\SyliusGiftPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Tests\Tomsgu\SyliusGiftPlugin\Behat\Page\Shop\CompletePageInterface;

class CheckoutCompleteContext implements Context
{
    public function __construct(private CompletePageInterface $completePage)
    {
    }

    /**
     * @When I check the gift checkbox field
     */
    public function iCheckTheGiftCheckboxField(): void
    {
        $this->completePage->checkGiftCheckbox();
    }
}

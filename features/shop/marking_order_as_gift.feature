@checkout
Feature: Marking an order as a gift
    In order to mark an order as a gift
    As a customer
    I want to be able to see a gift checkbox field on complete checkout page.

    Background:
        Given the store operates on a single channel in "United States"
        And the store has a product "Lannister Coat" priced at "$19.99"
        And there is a gift option in the store with "GIFT" note
        And the store ships everywhere for free
        And the store allows paying offline
        And there is an administrator "sylius@example.com" identified by "sylius"
        And there is a customer account "customer@example.com" identified by "sylius"
        And I am logged in as "customer@example.com"
        And I add product "Lannister Coat" to the cart
        And I go to the checkout addressing step
        And I define the billing address as "Ankh Morpork", "Frost Alley", "90210", "United States" for "Jon Snow"
        And I proceed with "Free" shipping method and "Offline" payment
        Then I should be on the checkout summary step

    @ui
    Scenario: Place an order as a gift
        When I check the gift checkbox field
        And I confirm my order
        Then I should see the thank you page
        And I am logged in as an administrator
        And the administrator should see that order placed by "customer@example.com" has a gift note

    @ui
    Scenario: Place an order as a gift with additional note
        When I check the gift checkbox field
        And I provide additional note like "extra note"
        And I confirm my order
        Then I should see the thank you page
        And I am logged in as an administrator
        And the administrator should see that order placed by "customer@example.com" has a gift note

    @ui
    Scenario: Place an order without marking it as a gift
        And I confirm my order
        Then I should see the thank you page
        And I am logged in as an administrator
        And the administrator should see that order placed by "customer@example.com" has no note

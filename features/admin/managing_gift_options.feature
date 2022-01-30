@managing_gift_options
Feature: Managing gift options
    In order to have an overview on gift options in a shop
    As an Administrator
    I want to be able to create, edit, list and delete gift options

    Background:
        Given the store operates on a single channel in "United States"
        And I am logged in as an administrator

    @ui
    Scenario: Deleting gift option
        Given there is a gift option in the store
        When I go to the gift options page
        And I delete this gift option
        Then I should be notified that the gift option has been deleted
        And I should see empty list of gift options

    @ui
    Scenario: Updating gift option
        Given there is a gift option in the store
        When I want to edit this gift option
        And I change its label to "new label"
        And I change its note to "new note"
        And I save my changes
        Then I should be notified that the gift option was updated

    @ui
    Scenario: Adding a new gift option
        When I want to add a new gift option
        And I fill its label to "new label"
        And I fill its note to "new note"
        And I submit the form
        Then I should be notified that the gift option was added

    @ui
    Scenario: Adding a new gift option with blank data
        When I want to add a new gift option
        And I submit the form
        Then I should be notified that "Note, Label" fields cannot be blank


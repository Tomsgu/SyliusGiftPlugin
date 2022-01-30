# Tomsgu SyliusGiftPlugin

Adds a checkbox to a customer check out page indicating that it's a 
gift for a different person.

* [Installation](#installation)
* [Troubleshooting](#troubleshooting)

## Installation
### Step 1: Download the plugin

```bash
$ composer require tomsgu/sylius-gift-plugin
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.


### Step 2: Enable the plugin

Enable the plugin by adding it to the list of registered bundles:

```php
<?php
# config/bundles.php

return [
    // ...
    
    Tomsgu\SyliusGiftPlugin\TomsguSyliusGiftPlugin::class => ['all' => true],
    
    // It is important to add plugin before the grid bundle
    Sylius\Bundle\GridBundle\SyliusGridBundle::class => ['all' => true],
    
    // ...
];
```

### Step 3: Import config
```yaml
# config/packages/_sylius.yaml
imports:
    # ...
    - { resource: '@TomsguSyliusGiftPlugin/Resources/config/app/config.yaml' }
    # ...
```

### Step 4: Import routing

```yaml
# config/routes/tomsgu_sylius_gift.yaml

tomsgu_sylius_gift_admin:
    resource: "@TomsguSyliusGiftPlugin/Resources/config/routes/admin.yaml"
    prefix: /admin
```

### Step 5: Update a database schema

```bash
$ php bin/console doctrine:migrations:diff
$ php bin/console doctrine:migrations:migrate
```

### Step 6: Override checkout complete form

Override the [Sylius Form](https://github.com/Sylius/Sylius/blob/master/src/Sylius/Bundle/ShopBundle/Resources/views/Checkout/Complete/_form.html.twig):

* If you haven't override the `templates/bundles/SyliusShopBundle/Checkout/Complete/_form.html.twig` template yet, 
  copy `src/Resources/views/bundles/SyliusShopBundle/Checkout/Complete/_form.html.twig` file to:
  `templates/bundles/SyliusShopBundle/Checkout/Complete/_form.html.twig`

    ```bash
    $ cp vendor/tomsgu/sylius-gift-plugin/src/Resources/bundles/SyliusShopBundle/Checkout/Complete/_form.html.twig \
    templates/bundles/SyliusShopBundle/Checkout/Complete/_form.html.twig
    ```

* If you've already override it, add a following snippet to that template:

    ```twig
    {# templates/bundles/SyliusShopBundle/Checkout/Complete/_form.html.twig #}
    {% if form.gift_option is defined %}
        {{ form_row(form.gift_option) }}
    {% endif %}
    ```

## Troubleshooting
* If you get `You have requested a non-existent parameter "tomsgu_sylius_gift.model.gift_option.class"` 
  exception, you must instantiate the plugin before the grid bundle. See 
  [Step 3: Import config](#step-3-import-config) section.

# Upgrade Guide

## From 1.x to 2.0

The 2.0 release of `tomsgu/sylius-gift-plugin` drops support for Sylius 1.x and Symfony 5/6. It targets Sylius 2.x and ships with a modern bundle layout. This release is intentionally not backward-compatible — please plan your upgrade accordingly.

### Requirements

| Component | 1.x | 2.0 |
|-----------|-----|-----|
| PHP       | `^8.0` | `^8.2` |
| Sylius    | `^1.11 \|\| ^1.12` | `^2.0` |
| Symfony   | `^5.2 \|\| ^6.x` | `^7.4` |

Upgrade your Sylius application to `^2.0` before installing this version of the plugin.

### Configuration file paths moved out of `Resources/`

The plugin now uses the Symfony 7 / Sylius 2 layout. All plugin configuration files have moved from `src/Resources/` to root-level directories:

```
src/Resources/config/        →  config/
src/Resources/views/         →  templates/
src/Resources/translations/  →  translations/
```

If your application overrides the plugin's templates or imports its config files, update your paths:

```yaml
# Before
imports:
    - { resource: '@TomsguSyliusGiftPlugin/Resources/config/app/config.yaml' }

# After
imports:
    - { resource: '@TomsguSyliusGiftPlugin/config/app/config.yaml' }
```

### Admin form template override removed

The 1.x plugin shipped a custom admin form template referenced via the resource route's `vars.all.templates.form`. Sylius 2.x renders admin forms through Twig Hooks (`sylius_admin.<resource>.update.content`), so the route override was removed.

If your application overrode `@TomsguSyliusGiftPlugin/Admin/GiftOption/_form.html.twig`, port your customization to a Twig Hook entry pointing at the `sylius_admin.gift_option.update.content.form.sections.general` hook instead.

### Shop checkout template override replaced by Twig Hook

The 1.x plugin overrode `@SyliusShopBundle/Checkout/Complete/_form.html.twig` to inject the gift checkbox. In 2.0 this is registered as a Twig Hook on `sylius_shop.checkout.complete.content.form`. The new template lives at `templates/Shop/Checkout/Complete/_gift_option.html.twig` and is wired up in `config/twig_hooks/shop.yaml`.

No action is required unless your application replaced the 1.x override — in which case, switch to a competing Twig Hook entry rather than another template override.

### `CheckoutCompleteType` no longer re-adds the `notes` field

In 1.x the type extension re-defined the `notes` text area. Sylius 2.x's core `CompleteType` already provides it, so the duplicate definition was removed. If you extended `Tomsgu\SyliusGiftPlugin\Form\Type\CheckoutCompleteType` to customize that `notes` field, move your customization to an extension of `Sylius\Bundle\CoreBundle\Form\Type\Checkout\CompleteType` instead.

### Admin menu icon

The admin menu icon and grid icon switched from Semantic UI (`gift`) to Tabler (`tabler:gift`), matching Sylius 2.x.

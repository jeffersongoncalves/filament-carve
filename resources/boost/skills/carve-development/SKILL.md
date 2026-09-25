---
name: carve-development
description: Build and work with the Filament Carve plugin, including the CarveEditor form field, CarveEntry infolist entry, CarveColumn table column, laravel-carve render profiles and Carve validation.
---

# Filament Carve Development

## When to use this skill

Use this skill when:
- Editing Carve markup in a Filament form
- Showing rendered Carve content in an infolist or a table
- Restricting or validating the markup users may write
- Choosing a laravel-carve render profile for trusted or user generated content

## Editor

```php
use JeffersonGoncalves\Filament\Carve\Forms\Components\CarveEditor;

CarveEditor::make('body')
    ->profile('comment')  // profile used by the preview modal
    ->preset('comment')   // disallowed markup fails validation
    ->strict()            // parse warnings fail validation
    ->lint()              // lint findings fail validation
    ->previewable(false); // hide the "Preview" hint action
```

The source is always validated with `JeffersonGoncalves\Carve\Rules\ValidCarve`. `getCarveRule()` returns the configured rule.

## Infolist entry

```php
use JeffersonGoncalves\Filament\Carve\Infolists\Components\CarveEntry;

CarveEntry::make('body')->profile('trusted');
```

Renders the state as HTML inside prose styling. Blank state renders nothing.

## Table column

```php
use JeffersonGoncalves\Filament\Carve\Tables\Columns\CarveColumn;

CarveColumn::make('body')->limit(80); // plain text via Carve::toText()
CarveColumn::make('body')->html();    // HTML via Carve::toHtml()
```

## Profiles

Profiles live in laravel-carve's `config/carve.php` (`php artisan vendor:publish --tag="carve-config"`). The published config ships `default` (safe), `comment` (strict safe mode, comment preset) and `trusted` (no safe mode).

## Troubleshooting

### `Carve profile "x" is not defined`

**Cause**: `profile()` names a profile missing from `carve.profiles`.

**Solution**: Add the profile to `config/carve.php` or use an existing one.

### Raw HTML shows up in rendered output

**Cause**: The profile has `safe_mode => false`.

**Solution**: Use a safe profile (`default`, `comment`) for anything users can write.

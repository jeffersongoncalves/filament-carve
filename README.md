# Filament Carve

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-carve.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-carve)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-carve/tests.yml?branch=3.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-carve/actions/workflows/tests.yml?query=branch%3A3.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-carve/pint.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-carve/actions/workflows/pint.yml?query=branch%3A3.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-carve.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-carve)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-carve.svg?style=flat-square)](LICENSE.md)

[Carve](https://markup-carve.github.io/carve/) markup for Filament, built on [jeffersongoncalves/laravel-carve](https://github.com/jeffersongoncalves/laravel-carve):

- `CarveEditor`: a textarea that validates Carve source and previews the rendered HTML in a modal.
- `CarveEntry`: an infolist entry that renders Carve source as HTML.
- `CarveColumn`: a table column that shows Carve source as plain text, or as HTML.

## Compatibility

| Package Version | Filament Version |
|-----------------|------------------|
| [1.x](https://github.com/jeffersongoncalves/filament-carve/tree/1.x) | 3.x |
| [2.x](https://github.com/jeffersongoncalves/filament-carve/tree/2.x) | 4.x |
| [3.x](https://github.com/jeffersongoncalves/filament-carve/tree/3.x) | 5.x |

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-carve
```

Rendering is configured by laravel-carve. Publish its config to change the render profiles (`default`, `comment`, `trusted`, ...):

```bash
php artisan vendor:publish --tag="carve-config"
```

## Usage

### Editor

```php
use JeffersonGoncalves\Filament\Carve\Forms\Components\CarveEditor;

CarveEditor::make('body')
    ->profile('comment')  // laravel-carve profile used by the preview
    ->preset('comment')   // fail validation on markup the preset does not allow
    ->strict()            // fail validation on parse warnings
    ->lint()              // fail validation on lint findings, such as Markdown's **bold**
    ->previewable(false); // hide the preview action
```

`CarveEditor` extends Filament's `Textarea`, so every textarea method (`rows()`, `autosize()`, `maxLength()`, ...) still works. The source is always checked with laravel-carve's `ValidCarve` rule.

### Infolist entry

```php
use JeffersonGoncalves\Filament\Carve\Infolists\Components\CarveEntry;

CarveEntry::make('body')
    ->profile('trusted');
```

### Table column

```php
use JeffersonGoncalves\Filament\Carve\Tables\Columns\CarveColumn;

CarveColumn::make('body')->limit(80); // plain text excerpt
CarveColumn::make('body')->html();    // rendered HTML
```

## Security

Rendered HTML is printed unescaped. Safety comes from the laravel-carve profile: use a `safe_mode` profile (the `default` and `comment` profiles are safe) for user supplied content, and a profile with `safe_mode => false` only for content you trust.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

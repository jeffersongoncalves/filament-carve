# Changelog

All notable changes to this project will be documented in this file.

## 3.1.0 - 2026-10-04

### What's changed

- Fix: `AsCarve` model values are now handled as source in `CarveEditor`, `CarveEntry` and `CarveColumn` (#8 by @dereuromark).
- Switch dependency from the abandoned `jeffersongoncalves/laravel-carve` to the official bridge `markup-carve/laravel-carve` ^0.1.7 (#9).

### ⚠️ Upgrade notes

- If your app uses the Carve package directly, rename imports from `JeffersonGoncalves\Carve.
- If you published `config/carve.php`, republish it: render profiles now live under the `converters` key instead of `profiles`.

See the README section "Upgrading from jeffersongoncalves/laravel-carve".

## [Unreleased]

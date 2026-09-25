## Filament Carve

Filament components for Carve markup, built on `jeffersongoncalves/laravel-carve`: a validated editor with a rendered preview, an infolist entry and a table column. Branches: 1.x (Filament 3), 2.x (Filament 4), 3.x (Filament 5). Requires PHP 8.2+.

### Installation

@verbatim
<code-snippet name="Install the plugin" lang="bash">
composer require jeffersongoncalves/filament-carve
php artisan vendor:publish --tag="carve-config"
</code-snippet>
@endverbatim

### Usage

@verbatim
<code-snippet name="Editor, entry and column" lang="php">
use JeffersonGoncalves\Filament\Carve\Forms\Components\CarveEditor;
use JeffersonGoncalves\Filament\Carve\Infolists\Components\CarveEntry;
use JeffersonGoncalves\Filament\Carve\Tables\Columns\CarveColumn;

CarveEditor::make('body')
    ->profile('comment')
    ->preset('comment')
    ->strict()
    ->lint();

CarveEntry::make('body')->profile('trusted');

CarveColumn::make('body')->limit(80); // plain text
CarveColumn::make('body')->html();    // rendered HTML
</code-snippet>
@endverbatim

### Key Methods

- `profile(?string)` - laravel-carve render profile (`config/carve.php`); null uses the default profile. Available on all three components.
- `CarveEditor::preset(?string)` - fail validation on markup the preset (`full`, `article`, `comment`, `minimal`) does not allow.
- `CarveEditor::strict()` - fail validation on parse warnings.
- `CarveEditor::lint()` - fail validation on lint findings, such as Markdown's `**bold**`.
- `CarveEditor::previewable(false)` - hide the preview hint action.

### Best Practices

- `CarveEditor` extends `Textarea`, `CarveEntry` extends `TextEntry`, `CarveColumn` extends `TextColumn`: their usual methods keep working.
- Rendered HTML is printed unescaped. Use a `safe_mode` profile (`default`, `comment`) for user content; `safe_mode => false` only for trusted content.
- Store Carve source in the database, not rendered HTML.

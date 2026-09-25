<?php

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\HtmlString;
use JeffersonGoncalves\Carve\Rules\ValidCarve;
use JeffersonGoncalves\Filament\Carve\Forms\Components\CarveEditor;
use JeffersonGoncalves\Filament\Carve\Infolists\Components\CarveEntry;
use JeffersonGoncalves\Filament\Carve\Tables\Columns\CarveColumn;

it('builds the carve validation rule from the editor options', function () {
    $rule = CarveEditor::make('body')->preset('comment')->getCarveRule();

    expect($rule)->toBeInstanceOf(ValidCarve::class)
        ->and(Validator::make(['body' => '*bold*'], ['body' => $rule])->passes())->toBeTrue()
        ->and(Validator::make(['body' => '# Heading'], ['body' => $rule])->passes())->toBeFalse();
});

it('fails lint findings only when lint is enabled', function () {
    $source = ['body' => '**bold**'];

    expect(Validator::make($source, ['body' => CarveEditor::make('body')->getCarveRule()])->passes())->toBeTrue()
        ->and(Validator::make($source, ['body' => CarveEditor::make('body')->lint()->getCarveRule()])->passes())->toBeFalse();
});

it('is previewable by default and stores the profile', function () {
    $editor = CarveEditor::make('body')->profile('comment');

    expect($editor->isPreviewable())->toBeTrue()
        ->and($editor->previewable(false)->isPreviewable())->toBeFalse()
        ->and($editor->getProfile())->toBe('comment');
});

it('renders the entry state as html', function () {
    $state = CarveEntry::make('body')->formatState('Some *bold* text');

    expect($state)->toBeInstanceOf(HtmlString::class)
        ->and((string) $state)->toContain('<strong>bold</strong>');
});

it('renders the column as plain text by default and html on demand', function () {
    expect(CarveColumn::make('body')->formatState('Some *bold* text'))->toBe('Some bold text')
        ->and((string) CarveColumn::make('body')->html()->formatState('Some *bold* text'))->toContain('<strong>bold</strong>');
});

it('uses the given profile', function () {
    $html = (string) CarveEntry::make('body')->profile('comment')->formatState('<b>raw</b>');

    expect($html)->not->toContain('<b>');
});

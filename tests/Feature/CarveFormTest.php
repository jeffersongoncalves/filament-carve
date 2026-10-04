<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Filament\Carve\Tests\Fixtures\CarveForm;
use JeffersonGoncalves\Filament\Carve\Tests\Fixtures\CarvePost;
use Livewire\Livewire;

it('renders the editor with the preview action', function () {
    Livewire::test(CarveForm::class)
        ->assertSee('Preview')
        ->fillForm(['body' => 'Some *bold* text'])
        ->mountFormComponentAction('body', 'carvePreview')
        ->assertSee('<strong>bold</strong>', escape: false);
});

it('validates the source against the preset', function () {
    Livewire::test(CarveForm::class)
        ->fillForm(['body' => '# Heading'])
        ->call('save')
        ->assertHasFormErrors(['body']);
});

it('hydrates validates previews and saves an AsCarve attribute as source', function () {
    Schema::create('carve_posts', function (Blueprint $table) {
        $table->id();
        $table->text('body')->nullable();
    });
    $record = CarvePost::create(['body' => 'Some *bold* text']);

    $livewire = Livewire::test(CarveForm::class, ['record' => $record])
        ->assertFormSet(['body' => 'Some *bold* text'])
        ->mountFormComponentAction('body', 'carvePreview')
        ->assertSee('<strong>bold</strong>', escape: false)
        ->assertDontSee('&lt;strong&gt;', escape: false);

    expect($livewire->instance()->form->getFlatFields()['body']->renderPreview())
        ->toContain('<strong>bold</strong>')->not->toContain('&lt;strong&gt;');

    $livewire->unmountFormComponentAction()
        ->fillForm(['body' => 'Edited /italic/ text'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($record->fresh()->getRawOriginal('body'))->toBe('Edited /italic/ text');
});

<?php

use JeffersonGoncalves\Filament\Carve\Tests\Fixtures\CarveForm;
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

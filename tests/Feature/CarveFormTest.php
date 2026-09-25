<?php

use Filament\Actions\Testing\TestAction;
use JeffersonGoncalves\Filament\Carve\Tests\Fixtures\CarveForm;
use Livewire\Livewire;

it('renders the editor with the preview action', function () {
    $preview = TestAction::make('carvePreview')->schemaComponent('body');

    $livewire = Livewire::test(CarveForm::class)
        ->assertSee('Preview')
        ->fillForm(['body' => 'Some *bold* text'])
        ->mountAction($preview)
        ->assertActionMounted($preview);

    expect($livewire->instance()->form->getFlatFields()['body']->renderPreview())
        ->toContain('<strong>bold</strong>');
});

it('validates the source against the preset', function () {
    Livewire::test(CarveForm::class)
        ->fillForm(['body' => '# Heading'])
        ->call('save')
        ->assertHasFormErrors(['body']);
});

<?php

namespace JeffersonGoncalves\Filament\Carve\Tests\Fixtures;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use JeffersonGoncalves\Filament\Carve\Forms\Components\CarveEditor;
use Livewire\Component;

class CarveForm extends Component implements HasForms
{
    use InteractsWithForms;

    /** @var array<string, mixed> */
    public ?array $data = [];

    public ?CarvePost $record = null;

    public function mount(?CarvePost $record = null): void
    {
        $this->record = $record;
        $this->form->fill($record === null ? [] : ['body' => $record->body]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                CarveEditor::make('body')->preset('comment'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        if ($this->record !== null) {
            $this->record->body = $data['body'];
            $this->record->save();
        }
    }

    public function render(): string
    {
        return '<div>{{ $this->form }}<x-filament-actions::modals /></div>';
    }
}

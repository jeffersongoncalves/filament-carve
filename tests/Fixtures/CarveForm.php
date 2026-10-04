<?php

namespace JeffersonGoncalves\Filament\Carve\Tests\Fixtures;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Filament\Carve\Forms\Components\CarveEditor;
use Livewire\Component;

class CarveForm extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    /** @var array<string, mixed> */
    public ?array $data = [];

    public ?CarvePost $record = null;

    public function mount(?CarvePost $record = null): void
    {
        $this->record = $record;
        $this->form->fill($record === null ? [] : ['body' => $record->body]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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

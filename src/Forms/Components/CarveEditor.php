<?php

namespace JeffersonGoncalves\Filament\Carve\Forms\Components;

use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\HtmlString;
use JeffersonGoncalves\Carve\Facades\Carve;
use JeffersonGoncalves\Carve\Rules\ValidCarve;
use JeffersonGoncalves\Filament\Carve\Concerns\HasCarveProfile;

class CarveEditor extends Textarea
{
    use HasCarveProfile;

    protected string|Closure|null $carvePreset = null;

    protected bool|Closure $isCarveStrict = false;

    protected bool|Closure $isCarveLinted = false;

    protected bool|Closure $isPreviewable = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rows(10);

        $this->rule(fn (CarveEditor $component): ValidCarve => $component->getCarveRule());

        $this->hintAction(
            Action::make('carvePreview')
                ->label(__('filament-carve::carve.preview'))
                ->icon('heroicon-m-eye')
                ->visible(fn (): bool => $this->isPreviewable())
                ->modalHeading(__('filament-carve::carve.preview'))
                ->modalContent(fn (): HtmlString => new HtmlString(
                    '<div class="prose max-w-none dark:prose-invert">'.$this->renderPreview().'</div>'
                ))
                ->modalSubmitAction(false)
                ->modalCancelActionLabel(__('filament-carve::carve.close')),
        );
    }

    /**
     * Fail validation when the source uses markup the carve preset
     * (full, article, comment, minimal) does not allow.
     */
    public function preset(string|Closure|null $preset): static
    {
        $this->carvePreset = $preset;

        return $this;
    }

    /**
     * Fail validation on parse warnings, such as undefined references.
     */
    public function strict(bool|Closure $condition = true): static
    {
        $this->isCarveStrict = $condition;

        return $this;
    }

    /**
     * Fail validation on lint findings, such as Markdown's **bold**.
     */
    public function lint(bool|Closure $condition = true): static
    {
        $this->isCarveLinted = $condition;

        return $this;
    }

    public function previewable(bool|Closure $condition = true): static
    {
        $this->isPreviewable = $condition;

        return $this;
    }

    public function getPreset(): ?string
    {
        return $this->evaluate($this->carvePreset);
    }

    public function isStrict(): bool
    {
        return (bool) $this->evaluate($this->isCarveStrict);
    }

    public function isLinted(): bool
    {
        return (bool) $this->evaluate($this->isCarveLinted);
    }

    public function isPreviewable(): bool
    {
        return (bool) $this->evaluate($this->isPreviewable);
    }

    public function getCarveRule(): ValidCarve
    {
        $preset = $this->getPreset();

        return ($preset === null ? new ValidCarve : ValidCarve::preset($preset))
            ->strict($this->isStrict())
            ->lint($this->isLinted());
    }

    public function renderPreview(): string
    {
        $state = $this->getState();

        return blank($state) ? '' : Carve::toHtml((string) $state, $this->getProfile());
    }
}

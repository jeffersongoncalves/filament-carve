<?php

namespace JeffersonGoncalves\Filament\Carve\Infolists\Components;

use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\HtmlString;
use JeffersonGoncalves\Carve\Facades\Carve;
use JeffersonGoncalves\Filament\Carve\Concerns\HasCarveProfile;

class CarveEntry extends TextEntry
{
    use HasCarveProfile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prose();

        $this->formatStateUsing(fn (mixed $state): ?HtmlString => blank($state)
            ? null
            : new HtmlString(Carve::toHtml((string) $state, $this->getProfile())));
    }
}

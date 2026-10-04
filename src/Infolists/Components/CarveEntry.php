<?php

namespace JeffersonGoncalves\Filament\Carve\Infolists\Components;

use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\HtmlString;
use JeffersonGoncalves\Filament\Carve\Concerns\HasCarveProfile;
use JeffersonGoncalves\Filament\Carve\Concerns\HasCarveSource;
use MarkupCarve\LaravelCarve\Facades\Carve;

class CarveEntry extends TextEntry
{
    use HasCarveProfile;
    use HasCarveSource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prose();

        $this->formatStateUsing(function (mixed $state): ?HtmlString {
            $source = $this->getCarveSource($state);

            return $source === null ? null : new HtmlString(Carve::toHtml($source, $this->getProfile()));
        });
    }
}

<?php

namespace JeffersonGoncalves\Filament\Carve\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;
use JeffersonGoncalves\Carve\Facades\Carve;
use JeffersonGoncalves\Filament\Carve\Concerns\HasCarveProfile;
use JeffersonGoncalves\Filament\Carve\Concerns\HasCarveSource;

/**
 * Shows the source as plain text (works with ->limit() and ->words()),
 * or as rendered HTML when ->html() is set.
 */
class CarveColumn extends TextColumn
{
    use HasCarveProfile;
    use HasCarveSource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formatStateUsing(function (mixed $state): string|HtmlString|null {
            $state = $this->getCarveSource($state);
            if ($state === null) {
                return null;
            }

            return $this->isHtml()
                ? new HtmlString(Carve::toHtml((string) $state, $this->getProfile()))
                : Carve::toText((string) $state, $this->getProfile());
        });
    }
}

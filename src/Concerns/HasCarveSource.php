<?php

namespace JeffersonGoncalves\Filament\Carve\Concerns;

use JeffersonGoncalves\Carve\RenderedCarve;

trait HasCarveSource
{
    protected function getCarveSource(mixed $state): ?string
    {
        $source = $state instanceof RenderedCarve ? $state->source : $state;
        if (is_array($source) && is_string($source['source'] ?? null)) {
            $source = $source['source'];
        }

        return is_scalar($source) || $source instanceof \Stringable ? (string) $source : null;
    }
}

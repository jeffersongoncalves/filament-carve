<?php

namespace JeffersonGoncalves\Filament\Carve\Forms\StateCasts;

use Filament\Schemas\Components\StateCasts\Contracts\StateCast;
use JeffersonGoncalves\Filament\Carve\Concerns\HasCarveSource;

class CarveSourceStateCast implements StateCast
{
    use HasCarveSource;

    public function get(mixed $state): mixed
    {
        return $this->getCarveSource($state);
    }

    public function set(mixed $state): mixed
    {
        return $this->getCarveSource($state);
    }
}

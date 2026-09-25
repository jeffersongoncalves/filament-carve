<?php

namespace JeffersonGoncalves\Filament\Carve\Concerns;

use Closure;

trait HasCarveProfile
{
    protected string|Closure|null $carveProfile = null;

    /**
     * The laravel-carve render profile (see config/carve.php). Null uses the default profile.
     */
    public function profile(string|Closure|null $profile): static
    {
        $this->carveProfile = $profile;

        return $this;
    }

    public function getProfile(): ?string
    {
        return $this->evaluate($this->carveProfile);
    }
}

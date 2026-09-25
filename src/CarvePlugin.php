<?php

namespace JeffersonGoncalves\Filament\Carve;

use Filament\Contracts\Plugin;
use Filament\Panel;

class CarvePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-carve';
    }

    public function register(Panel $panel): void
    {
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }
}

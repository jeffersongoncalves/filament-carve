<?php

namespace JeffersonGoncalves\Filament\Carve;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CarveServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-carve')
            ->hasTranslations();
    }
}

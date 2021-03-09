<?php

namespace Sashalenz\Tecdoc;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TecdocServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('a20-tecdoc-api')
            ->hasRoute('web')
            ->hasConfigFile();
    }
}

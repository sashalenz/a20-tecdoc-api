<?php

namespace Sashalenz\Tecdoc;

use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TecdocServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('a20-tecdoc-api')
            ->hasViews()
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        $this->loadViewComponentsAs('wireforms', [
            \Sashalenz\Tecdoc\Components\Fields\TecdocBrand::class,
            \Sashalenz\Tecdoc\Components\Fields\TecdocModel::class,
            \Sashalenz\Tecdoc\Components\Fields\TecdocVehicle::class
        ]);

        Livewire::component(
            'sashalenz.tecdoc.livewire.tecdoc-brand-select',
            \Sashalenz\Tecdoc\Livewire\TecdocBrandSelect::class
        );

        Livewire::component(
            'sashalenz.tecdoc.livewire.tecdoc-model-select',
            \Sashalenz\Tecdoc\Livewire\TecdocModelSelect::class
        );

        Livewire::component(
            'sashalenz.tecdoc.livewire.tecdoc-vehicle-select',
            \Sashalenz\Tecdoc\Livewire\TecdocVehicleSelect::class
        );
    }
}

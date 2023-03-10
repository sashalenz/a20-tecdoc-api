<?php

namespace Sashalenz\Tecdoc\Livewire;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\ApiModels\Brand;
use Sashalenz\Tecdoc\Data\BrandData;
use Sashalenz\Tecdoc\Exceptions\TecdocException;

final class TecdocBrandSelect extends TecdocBaseSelect
{
    public function getResultsProperty(): ?Collection
    {
        if (! $this->isOpen) {
            return collect();
        }

        try {
            return Brand::make()
                ->search($this->search)
                ->get()
                ->mapWithKeys(fn (BrandData $data) => $data->mapWithKeys());
        } catch (TecdocException) {
            return collect();
        }
    }
}

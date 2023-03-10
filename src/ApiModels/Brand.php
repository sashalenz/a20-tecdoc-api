<?php

namespace Sashalenz\Tecdoc\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\Data\BrandData;
use Sashalenz\Tecdoc\Exceptions\TecdocException;
use Sashalenz\Tecdoc\Tecdoc;

final class Brand extends Tecdoc
{
    /**
     * @throws TecdocException
     */
    public function get(): Collection
    {
        return $this
            ->request('getManufacturers')
            ->map(fn (array $brand) => BrandData::from($brand))
            ->values();
    }
}

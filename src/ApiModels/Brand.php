<?php

namespace Sashalenz\Tecdoc\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\DataTransferObjects\BrandDataTransferObject;
use Sashalenz\Tecdoc\Exceptions\TecdocException;
use Sashalenz\Tecdoc\Tecdoc;

final class Brand extends Tecdoc
{
    /**
     * @param string|null $search
     * @return Collection
     * @throws TecdocException
     */
    public function get(?string $search = null): Collection
    {
        return $this
            ->search($search)
            ->request('getManufacturers')
            ->map(fn (array $brand) => BrandDataTransferObject::fromArray($brand))
            ->values();
    }
}

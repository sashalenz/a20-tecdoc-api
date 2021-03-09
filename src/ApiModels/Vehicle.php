<?php

namespace Sashalenz\Tecdoc\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\DataTransferObjects\VehicleDataTransferObject;
use Sashalenz\Tecdoc\Exceptions\TecdocException;
use Sashalenz\Tecdoc\Tecdoc;

final class Vehicle extends Tecdoc
{
    /**
     * @param $modelId
     * @param string|null $search
     * @return Collection
     * @throws TecdocException
     */
    public function get($modelId, ?string $search = ''): Collection
    {
        return $this
            ->search($search)
            ->property('model_id', $modelId)
            ->request('getPassangerCars')
            ->map(fn ($vehicle) => VehicleDataTransferObject::arrayOf($vehicle))
            ->values();
    }

    /**
     * @param $id
     * @return VehicleDataTransferObject|null
     * @throws TecdocException
     */
    public function find($id):? VehicleDataTransferObject
    {
        $vehicle = $this
            ->property('passanger_car_id', $id)
            ->request('getPassangerCarById')
            ->toArray();

        if (!$vehicle) {
            return null;
        }

        return VehicleDataTransferObject::fromArray($vehicle);
    }

}

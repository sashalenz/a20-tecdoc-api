<?php

namespace Sashalenz\Tecdoc\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\Data\VehicleData;
use Sashalenz\Tecdoc\Exceptions\TecdocException;
use Sashalenz\Tecdoc\Tecdoc;

final class Vehicle extends Tecdoc
{
    /**
     * @throws TecdocException
     */
    public function get($modelId): Collection
    {
        return $this
            ->property('model_id', $modelId)
            ->request('getPassangerCars')
            ->map(fn (array $vehicle) => VehicleData::from($vehicle))
            ->values();
    }

    /**
     * @throws TecdocException
     */
    public function find($id):? VehicleData
    {
        $vehicle = $this
            ->property('passanger_car_id', $id)
            ->request('getPassangerCarById')
            ->toArray();

        if (!$vehicle) {
            return null;
        }

        return VehicleData::from($vehicle);
    }

}

<?php

namespace Sashalenz\Tecdoc\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sashalenz\Tecdoc\ApiModels\Vehicle;
use Sashalenz\Tecdoc\DataTransferObjects\VehicleDataTransferObject;
use Sashalenz\Tecdoc\Exceptions\TecdocException;

class VehicleController
{
    private Vehicle $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws TecdocException
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'results' => $this->vehicle
                ->get(
                    $request->input('brand_id'),
                    $request->input('search')
                )
                ->map(fn (VehicleDataTransferObject $vehicle) => [
                    'id' => $vehicle->id,
                    'text' => $vehicle->name
                ])
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws TecdocException
     */
    public function show($id): JsonResponse
    {
        return response()->json([
            'results' => $this->vehicle->find($id)
        ]);
    }

}

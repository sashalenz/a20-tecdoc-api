<?php

namespace Sashalenz\Tecdoc\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sashalenz\Tecdoc\ApiModels\Brand;
use Sashalenz\Tecdoc\Exceptions\TecdocException;

class BrandController
{
    private Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws TecdocException
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'results' => $this->brand
                ->get($request->input('search'))
                ->map(fn ($model) => [
                    'id' => $model->id,
                    'text' => $model->name
                ])
        ]);
    }
}

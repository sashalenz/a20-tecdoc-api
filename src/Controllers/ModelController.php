<?php

namespace Sashalenz\Tecdoc\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sashalenz\Tecdoc\ApiModels\Model;
use Sashalenz\Tecdoc\DataTransferObjects\ModelDataTransferObject;
use Sashalenz\Tecdoc\Exceptions\TecdocException;

class ModelController
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws TecdocException
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'results' => $this->model
                ->get(
                    $request->input('brand_id'),
                    $request->input('search')
                )
                ->map(fn (ModelDataTransferObject $model) => [
                    'id' => $model->id,
                    'text' => $model->name
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
            'results' => $this->model->find($id)
        ]);
    }
}

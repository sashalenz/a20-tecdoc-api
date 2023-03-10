<?php

namespace Sashalenz\Tecdoc\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\Data\ModelData;
use Sashalenz\Tecdoc\Exceptions\TecdocException;
use Sashalenz\Tecdoc\Tecdoc;

final class Model extends Tecdoc
{
    /**
     * @throws TecdocException
     */
    public function get($brandId): Collection
    {
        return $this
            ->property('manufacturer_id', $brandId)
            ->request('getModels')
            ->map(fn (array $model) => ModelData::from($model))
            ->values();
    }

    /**
     * @throws TecdocException
     */
    public function find($id):? ModelData
    {
        $model = $this
            ->property('model_id', $id)
            ->request('getModelById')
            ->toArray();

        if (!$model) {
            return null;
        }

        return ModelData::from($model);
    }
}

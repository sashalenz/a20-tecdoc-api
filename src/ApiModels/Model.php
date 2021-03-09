<?php

namespace Sashalenz\Tecdoc\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\DataTransferObjects\ModelDataTransferObject;
use Sashalenz\Tecdoc\Exceptions\TecdocException;
use Sashalenz\Tecdoc\Tecdoc;

final class Model extends Tecdoc
{
    /**
     * @param $brandId
     * @param string|null $search
     * @return Collection
     * @throws TecdocException
     */
    public function get($brandId, ?string $search = ''): Collection
    {
        return $this
            ->search($search)
            ->property('manufacturer_id', $brandId)
            ->request('getModels')
            ->map(fn ($model) => ModelDataTransferObject::arrayOf($model))
            ->values();
    }

    /**
     * @param $id
     * @return ModelDataTransferObject|null
     * @throws TecdocException
     */
    public function find($id):? ModelDataTransferObject
    {
        $model = $this
            ->property('model_id', $id)
            ->request('getModelById')
            ->toArray();

        if (!$model) {
            return null;
        }

        return ModelDataTransferObject::fromArray($model);
    }
}

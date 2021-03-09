<?php

namespace Sashalenz\Tecdoc\DataTransferObjects;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class VehicleAttributesDataTransferObject extends FlexibleDataTransferObject
{
    public string $type;
    public string $value;

    public static function fromArray(array $array): self
    {
        return new self([
            'type' => $array['attributetype'],
            'value' => $array['displayvalue']
        ]);
    }

    public static function collectionFromArray(array $array): Collection
    {
        return collect($array)
            ->map(fn ($parameters) => static::fromArray($parameters));
    }
}

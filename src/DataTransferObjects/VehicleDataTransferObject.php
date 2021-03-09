<?php

namespace Sashalenz\Tecdoc\DataTransferObjects;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class VehicleDataTransferObject extends FlexibleDataTransferObject
{
    public int $id;
    public string $name;
    public string $description;
    public string $years;
    public string $engines;
    public Collection $attributes;
    public ?string $capacityTechnology = null;
    public ?string $powerKw = null;
    public ?string $powerPs = null;
    public ?string $bodyType = null;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => $array['id'],
            'description' => $array['description'],
            'years' => $array['constructioninterval'],
            'name' => collect([$array['description'], '('.$array['constructioninterval'].')'])->implode(' '),
            'attributes' => VehicleAttributesDataTransferObject::collectionFromArray($array['attributes']),
            'engines' => collect($array['engines'])->pluck('description')->implode(',')
        ]);
    }

}

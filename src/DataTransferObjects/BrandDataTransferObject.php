<?php

namespace Sashalenz\Tecdoc\DataTransferObjects;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class BrandDataTransferObject extends FlexibleDataTransferObject
{
    public int $id;
    public string $name;
    public string $description;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int)$array['id'],
            'name' => $array['description'],
            'description' => $array['description']
        ]);
    }

}

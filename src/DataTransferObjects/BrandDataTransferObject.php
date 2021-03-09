<?php

namespace Sashalenz\Tecdoc\DataTransferObjects;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class BrandDataTransferObject extends FlexibleDataTransferObject
{
    public int $id;
    public string $name;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => $array['id'],
            'name' => $array['name']
        ]);
    }

}

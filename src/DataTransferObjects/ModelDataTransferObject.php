<?php

namespace Sashalenz\Tecdoc\DataTransferObjects;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class ModelDataTransferObject extends FlexibleDataTransferObject
{
    public int $id;
    public string $name;
    public string $description;
    public string $years;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => $array['id'],
            'name' => collect([$array['description'], '('.$array['constructioninterval'].')'])->implode(' '),
            'description' => $array['description'],
            'years' => $array['constructioninterval']
        ]);
    }
}

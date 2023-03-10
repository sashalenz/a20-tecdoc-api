<?php

namespace Sashalenz\Tecdoc\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ModelData extends Data
{
    public function __construct(
        public int $id,
        public string $description,
        #[MapInputName('constructioninterval')]
        public string|Optional $years
    ) {
    }

    public function mapWithKeys(): array
    {
        return [
            $this->id => $this->description
        ];
    }
}

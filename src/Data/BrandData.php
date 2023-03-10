<?php

namespace Sashalenz\Tecdoc\Data;

use Spatie\LaravelData\Data;

class BrandData extends Data
{
    public function __construct(
        public int $id,
        public string $description
    ) {
    }

    public function mapWithKeys(): array
    {
        return [
            $this->id => $this->description
        ];
    }
}

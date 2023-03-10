<?php

namespace Sashalenz\Tecdoc\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class VehicleData extends Data
{
    public function __construct(
        public int $id,
        public string $description,
        #[MapInputName('constructioninterval')]
        public string $years,
        public string|Optional $power_kw,
        public string|Optional $power_ps,
        public string|Optional $capacity_tax,
        public string|Optional $capacity_technical,
        public string|Optional $capacity,
        public string|Optional $number_of_valves,
        public string|Optional $number_of_cylinders,
        public string|Optional $engine_type,
        public string|Optional $body_type,
        public string|Optional $drive_type,
        public string|Optional $fuel_type,
        public string|Optional $fuel_mixture,
        public string|Optional $engine_code
    ) {
    }

    public function mapWithKeys(): array
    {
        return [
            $this->id => $this->description
        ];
    }
}

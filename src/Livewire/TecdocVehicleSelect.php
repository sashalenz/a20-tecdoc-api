<?php

namespace Sashalenz\Tecdoc\Livewire;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\ApiModels\Vehicle;
use Sashalenz\Tecdoc\Data\VehicleData;
use Sashalenz\Tecdoc\Exceptions\TecdocException;

final class TecdocVehicleSelect extends TecdocBaseSelect
{
    public ?int $modelId = null;

    public function mount(
        string $name,
        string $placeholder = null,
        string $value = null,
        bool $required = false,
        bool $readonly = false,
        ?int $minInputLength = null,
        ?int $limit = 20,
        bool $searchable = true,
        ?string $viewName = null,
        ?string $titleKey = null,
        ?string $titleValue = null,
        ?array $emitTo = [],
        ?int $modelId = null
    ): void {
        $this->name = $name;
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->readonly = $readonly;
        $this->minInputLength = $minInputLength;
        $this->limit = $limit;
        $this->searchable = $searchable;
        $this->viewName = $viewName;
        $this->titleKey = $titleKey;
        $this->titleValue = $titleValue;
        $this->emitTo = $emitTo;
        $this->modelId = $modelId;
    }


    public function getResultsProperty(): ?Collection
    {
        if (! $this->isOpen || ! $this->modelId) {
            return collect();
        }

        try {
            return Vehicle::make()
                ->search($this->search)
                ->get($this->modelId)
                ->mapWithKeys(fn (VehicleData $data) => $data->mapWithKeys());
        } catch (TecdocException) {
            return collect();
        }
    }
}

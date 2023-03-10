<?php

namespace Sashalenz\Tecdoc\Livewire;

use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\ApiModels\Model;
use Sashalenz\Tecdoc\Data\ModelData;
use Sashalenz\Tecdoc\Exceptions\TecdocException;

final class TecdocModelSelect extends TecdocBaseSelect
{
    public ?int $brandId = null;

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
        ?int $brandId = null
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
        $this->brandId = $brandId;
    }


    public function getResultsProperty(): ?Collection
    {
        if (! $this->isOpen || ! $this->brandId) {
            return collect();
        }

        try {
            return Model::make()
                ->search($this->search)
                ->get($this->brandId)
                ->mapWithKeys(fn (ModelData $data) => $data->mapWithKeys());
        } catch (TecdocException) {
            return collect();
        }
    }
}

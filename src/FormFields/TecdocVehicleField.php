<?php

namespace Sashalenz\Tecdoc\FormFields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\Components\Fields\TecdocModel;
use Sashalenz\Tecdoc\Components\Fields\TecdocVehicle;
use Xite\Wireforms\Contracts\FieldContract;
use Xite\Wireforms\FormFields\FormField;

class TecdocVehicleField extends FormField
{
    protected bool $nullable = false;
    protected bool $searchable = false;
    protected ?array $emitTo = [];
    protected ?int $minInputLength = null;
    protected ?string $titleKey = null;
    protected ?string $titleValue = null;
    protected ?int $modelId = null;

    public function emitTo(string $emitTo): self
    {
        $this->emitTo[] = $emitTo;

        return $this;
    }

    public function titleKey(?string $titleKey): self
    {
        $this->titleKey = $titleKey;

        return $this;
    }

    public function nullable(): self
    {
        $this->nullable = true;
        $this->rules[] = 'nullable';

        return $this;
    }

    public function searchable(): self
    {
        $this->searchable = true;

        return $this;
    }

    public function minInputLength(int $minInputLength): self
    {
        $this->minInputLength = $minInputLength;

        return $this;
    }

    public function modelId(?int $modelId = null): self
    {
        $this->modelId = $modelId;

        return $this;
    }

    public function renderField(?Model $model = null): Collection
    {
        if (! is_null($model)) {
            $this->value(
                $model->{$this->getName()}
            );

            if ($this->titleKey) {
                $this->titleValue = $model->{$this->titleKey};
            }
        }

        return collect([
            $this->render(),
        ]);
    }

    protected function render(): FieldContract
    {
        return TecdocVehicle::make(
            name: $this->getNameOrWireModel(),
            value: $this->value,
            nullable: $this->nullable,
            searchable: $this->searchable,
            label: $this->label,
            help: $this->help,
            placeholder: $this->placeholder,
            minInputLength: $this->minInputLength,
            required: $this->required,
            readonly: $this->disabled,
            key: $this->key,
            modelId: $this->modelId,
            emitTo: array_filter($this->emitTo),
            titleKey: $this->wireModel
                ? 'model.'.$this->titleKey
                : $this->titleKey,
            titleValue: $this->titleValue
        );
    }
}

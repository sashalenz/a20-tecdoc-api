<?php

namespace Sashalenz\Tecdoc\FormFields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Sashalenz\Tecdoc\Components\Fields\TecdocBrand;
use Xite\Wireforms\Contracts\FieldContract;
use Xite\Wireforms\FormFields\FormField;

class TecdocBrandField extends FormField
{
    protected bool $nullable = false;
    protected bool $searchable = false;
    protected ?array $emitTo = [];
    protected ?int $minInputLength = null;
    protected ?string $titleKey = null;
    protected ?string $titleValue = null;

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
        return TecdocBrand::make(
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
            emitTo: array_filter($this->emitTo),
            titleKey: $this->wireModel
                ? 'model.'.$this->titleKey
                : $this->titleKey,
            titleValue: $this->titleValue
        );
    }
}

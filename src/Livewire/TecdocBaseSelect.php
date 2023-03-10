<?php

namespace Sashalenz\Tecdoc\Livewire;

use Illuminate\Support\Str;
use Xite\Wireforms\Livewire\BaseSelect;

abstract class TecdocBaseSelect extends BaseSelect
{
    public ?string $titleKey = null;

    public ?string $titleValue = null;

    public array $emitTo = [];

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
        ?array $emitTo = []
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
    }

    public function setSelected($value): void
    {
        if ($this->value === $value) {
            $this->isOpen = false;

            return;
        }

        $this->value = $value;

        $this->emitUp(
            $this->emitUp,
            $this->name,
            $this->value
        );

        if ($this->titleKey) {
            $result = $this->results->get($value);
            $this->titleValue = $result;

            $this->emitUp(
                $this->emitUp,
                $this->titleKey,
                $result
            );
        }

        foreach ($this->emitTo as $emitTo) {
            $this->emitTo(
                $emitTo,
                Str::of($this->name)->prepend('updated')->camel()->toString(),
                $this->value
            );
        }

        $this->search = '';
        $this->isOpen = false;
    }

    public function showResults(): bool
    {
        return $this->searchable && (! is_int($this->minInputLength) || $this->minInputLength < Str::length($this->search));
    }

    public function getSelectedValueProperty(): ?string
    {
        return $this->value;
    }

    public function getSelectedTitleProperty(): ?string
    {
        return $this->titleValue;
    }

    public function isCurrent(string $key): bool
    {
        return ! is_null($this->selectedValue) && $key === $this->selectedValue;
    }
}

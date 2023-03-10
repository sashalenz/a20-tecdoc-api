<x-wireforms::fields
    :name="$name"
    :id="$id"
    :required="$required"
    :label="$label"
    :show-label="$showLabel"
    :help="$help"
    :key="$key"
    {{ $attributes->whereDoesntStartWith(['data', 'x-', 'wire:model', 'wire:change']) }}
>
    <div class="flex items-center"
        {{ $attributes->whereStartsWith(['x-']) }}
    >
        <livewire:sashalenz.tecdoc.livewire.tecdoc-vehicle-select
            :name="$id"
            :required="$required"
            :placeholder="$placeholder"
            :readonly="$readonly"
            :searchable="$searchable"
            :nullable="$nullable"
            :min-input-length="$minInputLength"
            :value="$value"
            :emit-to="$emitTo"
            :key="$key ?? $id"
            :title-key="$titleKey"
            :title-value="$titleValue"
            :model-id="$modelId"
        />
    </div>
</x-wireforms::fields>

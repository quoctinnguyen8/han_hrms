@props([
    'name',
    'label',
    'selected' => null,
    'model',
    'valueField',
    'textField',
])
@php
    $options = [];
    if ($model) {
        $model = 'App\\Models\\' . $model;
        if (!class_exists($model)) {
            throw new Exception("Model $model does not exist.");
        }
        $model = app($model);
        $options = $model::pluck($textField, $valueField);
    }
    if ($options->isEmpty()) {
        $options = collect([$valueField => $textField]);
    }
    $selected = $selected ?? request($name);
@endphp

<div class="mb-3">

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror" {{ $attributes }}>
        <option value="">-- Chọn {{ $label }} --</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>

    @error($name)
        <small class="invalid-feedback d-block">
            {{ $message }}
        </small>
    @enderror
</div>
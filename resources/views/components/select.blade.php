@props([
    'name',
    'label',
    'selected' => null,
    'model',
    'valueField',
    'textField',
    'options',
    'id'=> null,
])
@php
    $id = $id ?? $name;
    // nếu có options thì không cần lấy từ model
    if (isset($options) && is_array($options)) {
        // Không cần làm gì
    } else if (isset($model)) {
        // nếu không có options thì lấy từ model
        $model = 'App\\Models\\' . $model;
        if (!class_exists($model)) {
            throw new Exception("Model $model does not exist.");
        }
        $model = app($model);
        $options = $model::pluck($textField, $valueField);
    }
    $selected = $selected ?? request($name);
@endphp

<div class="mb-3">

    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}" class="form-select @error($name) is-invalid @enderror" {{ $attributes }}>
        <option value="">-- Chọn {{ $label }} --</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ strval(old($name, $selected)) === strval($key) ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>

    @error($name)
        <small class="invalid-feedback d-block">
            {{ $message }}
        </small>
    @enderror
</div>
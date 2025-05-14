@props([
    'label', 
    'name',
    'type' => null,
    'value' => null,
    'required' => false,
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" 
        class="form-control"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
    />
    @error($name)
        <p class="text-small fst-italic text-danger">{{ $message }}</p>
    @enderror
</div>

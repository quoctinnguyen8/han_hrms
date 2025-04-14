{{-- 
Component được dùng trong các form thông thường,
Lỗi hiển thị dưới input
Không dùng cho input ở modal
--}}

@php
    $name = $attributes->get('name');
    $value = $attributes->get('value');
    $type = $attributes->get('type', 'text');
    $id = $attributes->get('id', $name);
    $placeholder = $attributes->get('placeholder');
    $required = $attributes->get('required') ? 'required' : '';
    $disabled = $attributes->get('disabled') ? 'disabled' : '';
    $readonly = $attributes->get('readonly') ? 'readonly' : '';
    $class = $attributes->get('class') ? 'form-control ' . $attributes->get('class') : 'form-control';
    $label = $attributes->get('label') ? $attributes->get('label') : 'Label';
    $oldValue = old($name, $value);
    $error = $errors->has($name) ? 'is-invalid' : '';
    $errorMessage = $errors->first($name);
@endphp

<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$label}}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{$type}}"
        id="{{$id}}"
        name="{{$name}}"
        value="{{ $oldValue }}"
        placeholder="{{$placeholder}}"
        class="{{$class}} {{$error}}"
        {{$required}}
        {{$disabled}}
        {{$readonly}}
        @if($type == 'file')
            accept="image/*"
        @endif
        @if($type == 'email')
            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
        @endif />
    @if($error)
        <small class="invalid-feedback d-block">
            {{ $errorMessage }}
        </small>
    @endif
</div>
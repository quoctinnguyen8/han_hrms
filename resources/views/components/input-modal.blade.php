{{-- 
Component được dùng trong các form BÊN TRONG MODAL,
Lỗi không hiển thị bên dưới input
Dùng cho input ở modal kết hợp @error
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
        class="{{$class}}"
        {{$required}}
        {{$disabled}}
        {{$readonly}}
        @if($type == 'file')
            accept="image/*"
        @endif
        @if($type == 'email')
            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
        @endif />
</div>
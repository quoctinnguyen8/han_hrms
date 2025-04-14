@php
    $class = $attributes->get('class', 'btn-danger');
    $text = $attributes->get('text', 'Xóa');
    $icon = $attributes->get('icon', 'ri-delete-bin-5-line');
    $url = $attributes->get('url', '');
@endphp

<form action="{{$url}}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn {{$class}} js-btn-del">
        <i class="{{$icon}}"></i>
        {{$text}}
    </button>
</form>
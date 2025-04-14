@php
    $class = $attributes->get('class', 'btn-primary');
    $target = $attributes->get('target', '#');
    $text = $attributes->get('text', 'Thêm mới');
    $icon = $attributes->get('icon', 'ri-add-line');
    $url = $attributes->get('url', '');
@endphp

<button type="button" class="btn {{$class}} js-open-modal" data-bs-toggle="modal" 
    data-bs-target="{{$target}}" @if($url) data-url="{{$url}}" @endif>
    <i class="{{$icon}}"></i>
    {{$text}}
</button>
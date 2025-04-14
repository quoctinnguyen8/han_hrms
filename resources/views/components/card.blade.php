@php
    $header = $attributes->get('header', null);
    $footer = $attributes->get('footer', null);
    $class = $attributes->get('class', '');
@endphp

<div class="card {{ $class }}">
    @isset($header)
        <div class="card-header">
            {{ $header }}
        </div>
    @endisset
    <div class="card-body">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset

</div>

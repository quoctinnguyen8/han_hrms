@props([
    'title' => null
])

<div class="card">
    <div class="card-header">
        <h6 class="card-title mb-0">{{ $title }}</h6>
    </div>
    <div class="card-body">
        {{ $slot ?? '' }}
    </div>
</div>
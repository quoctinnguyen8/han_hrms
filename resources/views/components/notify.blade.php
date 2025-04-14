@php
    $closeButton = filter_var($attributes->get('closeButton', true), FILTER_VALIDATE_BOOLEAN);
@endphp

@session('success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        @if ($closeButton)
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endsession

@session('error')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        @if ($closeButton)
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endsession
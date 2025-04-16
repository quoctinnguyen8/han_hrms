
@php
    $headers = $attributes->get('headers', []);
    $data = $attributes->get('data', []);
    $primaryKey = $attributes->get('key', 'id');
@endphp

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            @foreach($headers as $h)
                <th class="align-content-center">{{ $h }}</th>
            @endforeach
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                @foreach($row->getAttributes() as $key => $value)
                    <td>{{ $value }}</td>
                @endforeach
                <td data-id="{{ $row->$primaryKey }}" style="width: 1%; white-space: nowrap;">
                    @isset($action)
                        {{ $action }}
                    @endisset
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
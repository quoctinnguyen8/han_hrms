@extends('admin.layout.app')
@section('title', 'Danh sách phòng ban')
@section('content')
    <x-card title="Danh sách phòng ban">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mCreate">
            Thêm phòng ban
        </button>

        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên phòng ban</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $d)
                    <tr>
                        <td>{{ $d->department_code }}</td>
                        <td>{{ $d->department_name }}</td>
                        <td>{{ $d->address }}</td>
                        <td>{{ $d->department_phone_number }}</td>
                        <td>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mEdit"
                                data-url="{{ route('admin.department.edit', $d->department_code) }}">
                                <i class="ri-edit-2-line"></i> Sửa
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{ $departments->links() }}

        <x-modal id="mCreate" title="Thêm phòng ban">
            <form action="{{ route('admin.department.store') }}" method="POST">
                @csrf
                <x-app-input label="Mã phòng ban" name="department_code" />
                <x-app-input label="Tên phòng ban" name="department_name" />
                <x-app-input label="Địa chỉ" name="address" />
                <x-app-input label="Số điện thoại" name="department_phone_number" />
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </x-modal>
        <x-modal id="mEdit" title="Sửa phòng ban">
            {{-- Nội dung trang edit sẽ được load vào đây --}}
        </x-modal>
    </x-card>

    <script>
        const myModalEl = document.getElementById('mEdit')
        myModalEl.addEventListener('show.bs.modal', async function(event) {
            const url = event.relatedTarget.getAttribute('data-url')
            // console.log(url);
            const response = await fetch(url);
            const html = await response.text();
            // đưa html vào modal-body
            const mBody = myModalEl.querySelector('.modal-body');
            mBody.innerHTML = html;
        })
    </script>
@endsection

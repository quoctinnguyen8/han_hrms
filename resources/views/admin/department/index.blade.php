@extends('admin.layout.app')
@section('title', 'Danh sách phòng ban')
@section('sidebar-key', 'admin.departments')

@section('content')

    <x-card class="col-12">
        <x-open-modal target="#mPhongBanCreate" />

        <x-table :headers="['Code', 'Tên phòng ban', 'Địa chỉ', 'Số điện thoại']" :data="$departments" key="department_code">
            <x-slot:action>
                <x-open-modal url="{{route('admin.departments.edit', ['department' => ':id'])}}"
                    text="Sửa" icon="ri-edit-line" target="#mPhongBanEdit" class="btn btn-warning btn-sm" />
                <x-del-button url="{{route('admin.departments.destroy', ['department' => ':id'])}}"
                    class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $departments->links() }}
    </x-card>
@endsection

@section('modal')
    <x-modal id="mPhongBanCreate" title="Thêm phòng ban">
        <form action="{{ route('admin.departments.store') }}" method="POST">
            @csrf
            <x-input-modal label="Mã phòng ban" name="department_code" required />
            <x-input-modal label="Tên phòng ban" name="department_name" required />
            <x-input-modal label="Địa chỉ" name="address" />
            <x-input-modal label="Số điện thoại" name="phone_number" />

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Thêm mới" />
            </div>
        </form>
    </x-modal>

    <x-modal id="mPhongBanEdit" title="Sửa thông tin phòng ban">
        {{-- Nội dung form sửa thông tin phòng ban sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection

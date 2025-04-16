@extends('admin.layout.app')
@section('title', 'Danh sách nhân viên')
@section('sidebar-key', 'admin.employee.list')

@section('content')

    <x-card class="col-12">
        <a href="{{ route('admin.employee.create') }}" class="btn btn-primary mb-3">
            <i class="ri-add-line"></i> Thêm nhân viên
        </a>
        <x-table :headers="['Mã nhân viên', 'Tên nhân viên', 'Địa chỉ', 'Số điện thoại']" :data="$employees" key="employee_code">
            <x-slot:action>
                <a href="{{ route('admin.employee.edit', ['employee' => ':id']) }}" class="btn btn-success btn-sm js-btn-edit">
                    <i class="ri-edit-line"></i> Chi tiết
                </a>
                <x-del-button url="{{ route('admin.employee.destroy', ['employee' => ':id']) }}" class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $employees->links() }}
    </x-card>

@endsection
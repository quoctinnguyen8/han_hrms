@extends('admin.layout.app')
@section('title', 'Danh sách nhân viên')
@section('sidebar-key', 'admin.employee.list')

@section('content')

    <x-card class="col-12">
        <div class="mb-3">
            <button type="button" class="btn btn-info" data-bs-toggle="collapse" data-bs-target="#search-form">
                <i class="ri-search-line"></i> Tìm kiếm
            </button>
            <a href="{{ route('admin.employee.create') }}" class="btn btn-primary">
                <i class="ri-add-line"></i> Thêm nhân viên
            </a>
        </div>
        @include('admin.employee._search')
        <x-table :headers="['Mã nhân viên', 'Tên nhân viên', 'Địa chỉ', 'Số điện thoại']" :data="$employees" key="employee_code">
            <x-slot:action>
                <a href="{{ route('admin.employee.edit', ['employee' => ':id']) }}" class="btn btn-success btn-sm js-btn-edit">
                    <i class="ri-edit-line"></i> Chi tiết
                </a>
                @if(Auth::guard('admin')->user()->is_del_empl)
                    <x-del-button url="{{ route('admin.employee.destroy', ['employee' => ':id']) }}" class="btn-danger btn-sm" />
                @endif
            </x-slot>
        </x-table>
        {{ $employees->links() }}
    </x-card>

@endsection
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
            <a href="{{ route('admin.exportExcel') }}" class="btn btn-outline-success">
                <i class="ri-file-excel-line"></i> Xuất file Excel
            </a>
        </div>
        @include('admin.employee._search')

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th class="align-content-center">ID</th>
                    <th class="align-content-center">Tên nhân viên</th>
                    <th class="align-content-center">Ngày sinh</th>
                    <th class="align-content-center">Địa chỉ</th>
                    <th class="align-content-center">Số điện thoại</th>
                    <th class="align-content-center">Phòng ban</th>
                    <th class="align-content-center">Chức vụ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $e)
                    <tr>
                        <td style="width: 1%; white-space: nowrap;">{{ $e->employee_code }}</td>
                        <td>{{ $e->full_name }}</td>
                        <td>{{ $e->birthday ? $e->birthday->format('d/m/Y') : '' }}</td>
                        <td>{{ $e->hometown }}</td>
                        <td>{{ $e->phone_number }}</td>
                        <td>{{ $e->department->department_name ?? 'Chưa có phòng ban' }}</td>
                        <td>{{ $e->employee_position->position_name ?? 'Chưa có chức vụ' }}</td>
                        <td data-id="{{ $e->employee_code }}" style="width: 1%; white-space: nowrap;">
                            <a href="{{ route('admin.employee.edit', ['employee' => ':id']) }}"
                                class="btn btn-success btn-sm js-btn-edit">
                                <i class="ri-edit-line"></i> Chi tiết
                            </a>
                            @if (Auth::guard('admin')->user()->is_del_empl)
                                <x-del-button url="{{ route('admin.employee.destroy', ['employee' => ':id']) }}"
                                    class="btn-danger btn-sm" />
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </x-card>

@endsection

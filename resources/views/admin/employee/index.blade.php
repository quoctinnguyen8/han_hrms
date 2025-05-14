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

        {{-- Form lọc tìm kiếm --}}
        <div id="search-form" class="collapse mb-4">
            <form method="GET" action="{{ route('admin.employee.index') }}" class="row g-3">
                <div class="col-md-3">
                    <x-input name="employee_code" label="Mã nhân viên" :value="request('employee_code')" />
                </div>
                <div class="col-md-3">
                    <x-input name="full_name" label="Tên nhân viên" :value="request('full_name')" />
                </div>
                <div class="col-md-3">
                    <x-select name="status" label="Trạng thái làm việc" :selected="request('status')" :options="['1' => 'Đang làm việc', '0' => 'Đã nghỉ việc']" />
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Tìm kiếm</button>
                    <a href="{{ route('admin.employee.index') }}" class="btn btn-secondary">Xóa lọc</a>
                </div>
            </form>
        </div>

      <x-table :headers="['Mã nhân viên', 'Tên nhân viên', 'Địa chỉ', 'Số điện thoại']" :data="$employees" key="employee_code">
    <x-slot:action>
        @foreach ($employees as $employee)
            <a href="{{ route('admin.employee.edit', ['employee' => $employee->employee_code]) }}" class="btn btn-success btn-sm js-btn-edit">
                <i class="ri-edit-line"></i> Chi tiết
            </a>

            @php
                $canDelete = $employee->status == 0 &&
                             $employee->date_quit &&
                             \Carbon\Carbon::parse($employee->date_quit)->lte(now()->subMonths(6));
            @endphp

            @if ($canDelete)
                <x-del-button url="{{ route('admin.employee.destroy', ['employee' => $employee->employee_code]) }}" class="btn-danger btn-sm" />
            @endif
        @endforeach
    </x-slot:action>
</x-table>


        {{ $employees->links() }}
    </x-card>

@endsection

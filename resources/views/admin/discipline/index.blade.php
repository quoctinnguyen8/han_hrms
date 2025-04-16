@extends('admin.layout.app')
@section('title', 'Thông tin kỷ luật của nhân viên ' . get_employee_name($employeeCode))

{{-- menu focus vào trang danh sách nhân viên --}}
@section('sidebar-key', 'admin.employee.list')

@section('content')
    <x-card class="col-12">
        <x-employee-tab :employeeCode="$employeeCode" activeTab="disciplines">
            <x-open-modal target="#mKyLuatCreate" />

            <x-table :headers="['ID', 'Ngày kỷ luật', 'Lý do', 'Tiền phạt']" :data="$disciplines" key="id">
                <x-slot:action>
                    <x-open-modal url="{{ route('admin.disciplines.edit', ['discipline' => ':id']) }}"
                        text="Sửa" icon="ri-edit-line" target="#mKyLuatEdit" class="btn btn-warning btn-sm" />
                    <x-del-button url="{{ route('admin.disciplines.destroy', ['discipline' => ':id']) }}"
                        class="btn-danger btn-sm" />
                </x-slot>
            </x-table>
            {{ $disciplines->links() }}
        </x-employee-tab>
    </x-card>
@endsection

@section('modal')
    <x-modal id="mKyLuatCreate" title="Thêm thông tin kỷ luật">
        <form action="{{ route('admin.disciplines.store') }}" method="POST">
            @csrf
            <input type="hidden" name="employee_code" value="{{ $employeeCode }}">
            <x-input-modal label="Ngày kỷ luật" name="discipline_date" type="date" required />
            <x-input-modal label="Lý do" name="reason" type="text" required />
            <x-input-modal label="Tiền phạt" name="discipline_money" type="number" required />

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Thêm mới" />
            </div>
        </form>
    </x-modal>

    <x-modal id="mKyLuatEdit" title="Sửa thông tin kỷ luật">
        {{-- Nội dung form sửa thông tin kỷ luật sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
@extends('admin.layout.app')
@section('title',  'Thông tin Khen thưởng của nhân viên ' . get_employee_name($employeeCode))
@section('sidebar-key', 'admin.employee.list')

{{-- menu focus vào trang danh sách nhân viên --}}

@section('content')
    <x-card class="col-12">
        <x-employee-tab :employeeCode="$employeeCode" activeTab="bonuses">
            <x-open-modal target="#mKhenThuongCreate" />

            <x-table :headers="['ID', 'Ngày thưởng', 'Lý do thưởng', 'Số tiền thưởng']" :data="$bonuses" key="id">
                <x-slot:action>
                    <x-open-modal url="{{ route('admin.bonuses.edit', ['bonus' => ':id']) }}"
                        text="Sửa" icon="ri-edit-line" target="#mKhenThuongEdit" class="btn btn-warning btn-sm" />
                    <x-del-button url="{{ route('admin.bonuses.destroy', ['bonus' => ':id']) }}"
                        class="btn-danger btn-sm" />
                </x-slot>
            </x-table>
            {{ $bonuses->links() }}
        </x-employee-tab>
    </x-card>
@endsection

@section('modal')
    <x-modal id="mKhenThuongCreate" title="Thêm thông tin khen thưởng">
        <form action="{{ route('admin.bonuses.store') }}" method="POST">
            @csrf
            <input type="hidden" name="employee_code" value="{{ $employeeCode }}">
            <x-input-modal label="Ngày thưởng" name="bonus_date" type="date" required />
            <x-input-modal label="Lý do thưởng" name="reason" required />
            <x-input-modal label="Số tiền thưởng" name="bonus_money" type="number" required />

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Thêm mới" />
            </div>
        </form>
    </x-modal>

    <x-modal id="mKhenThuongEdit" title="Sửa thông tin khen thưởng">
        {{-- Nội dung form sửa thông tin khen thưởng sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection

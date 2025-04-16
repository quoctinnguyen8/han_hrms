@extends('admin.layout.app')
@section('title',  'Thông tin trường đại học của nhân viên ' . get_employee_name($employeeCode))

{{-- menu focus vào trang danh sách nhân viên --}}
@section('sidebar-key', 'admin.employee.list')

@section('content')
    <x-card class="col-12">
        <x-employee-tab :employeeCode="$employeeCode" activeTab="after_universities">
            <x-open-modal target="#mTruongDaiHocCreate" />

            <x-table :headers="['ID', 'Chuyên ngành thạc sĩ', 'Nơi đào tạo thạc sĩ', 'Năm nhận bằng thạc sĩ', 'Chuyên ngành tiến sĩ', 'Nơi đào tạo tiến sĩ', 'Năm nhận bằng tiến sĩ']" :data="$afterUniversities" key="id">
                <x-slot:action>
                    <x-open-modal url="{{ route('admin.after_universities.edit', ['after_university' => ':id']) }}"
                        text="Sửa" icon="ri-edit-line" target="#mTruongDaiHocEdit" class="btn btn-warning btn-sm" />
                    <x-del-button url="{{ route('admin.after_universities.destroy', ['after_university' => ':id']) }}"
                        class="btn-danger btn-sm" />
                </x-slot>
            </x-table>
            {{ $afterUniversities->links() }}
        </x-employee-tab>
    </x-card>
@endsection

@section('modal')
    <x-modal id="mTruongDaiHocCreate" title="Thêm thông tin trường đại học">
        <form action="{{ route('admin.after_universities.store') }}" method="POST">
            @csrf
            <input type="hidden" name="employee_code" value="{{ $employeeCode }}">
            <x-input-modal label="Chuyên ngành thạc sĩ" name="specialized_master" required />
            <x-input-modal label="Nơi đào tạo thạc sĩ" name="training_place_master" required />
            <x-input-modal label="Năm nhận bằng thạc sĩ" name="degree_year_master" type="number" required />

            <x-input-modal label="Chuyên ngành tiến sĩ" name="specialized_doctorate" required />
            <x-input-modal label="Nơi đào tạo tiến sĩ" name="training_place_doctorate" required />
            <x-input-modal label="Năm nhận bằng tiến sĩ" name="degree_year_doctorate" type="number" required />

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Thêm mới" />
            </div>
        </form>
    </x-modal>

    <x-modal id="mTruongDaiHocEdit" title="Sửa thông tin trường đại học">
        {{-- Nội dung form sửa thông tin trường đại học sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
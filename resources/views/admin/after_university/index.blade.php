@extends('admin.layout.app')
@section('title',  'Thông tin trường đại học của nhân viên ' . get_employee_name($employeeCode))

{{-- menu focus vào trang danh sách nhân viên --}}
@section('sidebar-key', 'admin.employee.list')

@section('content')
    @include('admin._error')
    <x-card class="col-12">
        <x-employee-tab :employeeCode="$employeeCode" activeTab="after_universities">
            <x-open-modal target="#mTruongDaiHocCreate" />

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="align-content-center text-center" rowspan="2">ID</th>
                        <th class="align-content-center text-center" rowspan="2">Mã NV</th>
                        <th class="align-content-center text-center" rowspan="2">Tên NV</th>
                        <th class="align-content-center text-center" colspan="3">Đào tạo thạc sĩ</th>
                        <th class="align-content-center text-center" colspan="3">Đào tạo tiến sĩ</th>
                        <th class="align-content-center text-center" rowspan="2"></th>
                    </tr>
                    <tr>
                        <th class="align-content-center">Chuyên ngành</th>
                        <th class="align-content-center">Nơi đào tạo</th>
                        <th class="align-content-center">Năm nhận bằng</th>
                        <th class="align-content-center">Chuyên ngành</th>
                        <th class="align-content-center">Nơi đào tạo</th>
                        <th class="align-content-center">Năm nhận bằng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($afterUniversities as $afterUniversity)
                        <tr>
                            <td>{{ $afterUniversity->id }}</td>
                            <td>{{ $afterUniversity->employee_code }}</td>
                            <td>{{ $afterUniversity->full_name }}</td>
                            <td>{{ $afterUniversity->specialized_master }}</td>
                            <td>{{ $afterUniversity->training_place_master }}</td>
                            <td>{{ $afterUniversity->degree_year_master }}</td>
                            <td>{{ $afterUniversity->specialized_doctorate }}</td>
                            <td>{{ $afterUniversity->training_place_doctorate }}</td>
                            <td>{{ $afterUniversity->degree_year_doctorate }}</td>
                            <td>
                                <x-open-modal url="{{ route('admin.after_universities.edit', ['after_university' => ':id']) }}"
                                    text="Sửa" icon="ri-edit-line" target="#mTruongDaiHocEdit" class="btn btn-warning btn-sm" />
                                <x-del-button url="{{ route('admin.after_universities.destroy', ['after_university' => ':id']) }}"
                                    class="btn-danger btn-sm" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

            <x-input-modal label="Chuyên ngành tiến sĩ" name="specialized_doctorate" />
            <x-input-modal label="Nơi đào tạo tiến sĩ" name="training_place_doctorate" />
            <x-input-modal label="Năm nhận bằng tiến sĩ" name="degree_year_doctorate" type="number" />

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Thêm mới" />
            </div>
        </form>
    </x-modal>

    <x-modal id="mTruongDaiHocEdit" title="Sửa thông tin trường đại học">
        {{-- Nội dung form sửa thông tin trường đại học sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
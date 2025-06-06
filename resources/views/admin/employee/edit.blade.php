@extends('admin.layout.app')
@section('title', 'Sửa thông tin nhân viên ' . $employee->full_name)

{{-- menu focus vào trang danh sách nhân viên --}}
@section('sidebar-key', 'admin.employee.list')

@section('content')
    @include('admin._error')
    <x-card>
        <x-employee-tab :employeeCode="$employee->employee_code" activeTab="employee">
            <form action="{{ route('admin.employee.update', ['employee' => $employee->employee_code]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <x-input :value="$employee->employee_code" readonly label="Mã nhân viên" name="employee_code" required />
                        <x-input :value="$employee->username" label="Tên đăng nhập" name="username" />
                        <x-input label="Mật khẩu" name="password" type="password"
                            placeholder="Để trống nếu không thay đổi" />
                        <x-input :value="$employee->full_name" label="Họ và tên" name="full_name" required />
                        <x-input :value="date_format($employee->birthday, 'Y-m-d')" label="Ngày sinh" name="birthday" type="date" required />
                        <x-input :value="$employee->hometown" label="Quê quán" name="hometown" required />
                        <x-input :value="$employee->phone_number" label="Số điện thoại" name="phone_number" required />
                        <x-input :value="$employee->identity_card" label="CMND/CCCD" name="identity_card" />

                        <x-select name="gender" label="Giới tính" :selected="$employee->gender"
                            :options="[
                                '1'=>'Nam',
                                '0'=>'Nữ'
                            ]" />
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện</label>
                            @if ($employee->image)
                                <div class="mb-2">
                                    <img src="{{ asset($employee->image) }}" alt="Avatar"
                                        style="max-width: 100px; max-height: 100px;">
                                </div>
                            @endif
                            <input type="file" class="form-control" name="image" />
                        </div>

                        <x-input :value="$employee->ethnic" label="Dân tộc" name="ethnic" />

                        <x-select name="department_code" label="Phòng ban" valueField="department_code" textField="department_name" model="Department" :selected="$employee->department_code" />

                        <x-select name="employee_position_code" label="Vị trí" valueField="employee_position_code" textField="position_name" model="EmployeePosition" :selected="$employee->employee_position_code" />

                        <x-select name="specialized_code" label="Chuyên ngành" valueField="specialized_code" textField="specialized_name" model="Specialized" :selected="$employee->specialized_code" />

                        <x-select name="education_level_code" label="Trình độ học vấn" valueField="education_level_code" textField="education_level_name" model="EducationLevel" :selected="$employee->education_level_code" />

                        <x-select name="status" id="e_status" label="Trạng thái" :selected="$employee->status"
                            :options="[
                                '1' => 'Đang làm việc',
                                '0' => 'Ngừng làm việc'
                            ]" />
                    </div>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-success" value="Cập nhật" />
                </div>
            </form>
        </x-employee-tab>
    </x-card>
@endsection

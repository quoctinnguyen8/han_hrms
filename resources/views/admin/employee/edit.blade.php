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
                                ['label' => 'Nam', 'value' => 1],
                                ['label' => 'Nữ', 'value' => 0]
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

                        <x-select name="department_code" label="Phòng ban" :selected="$employee->department_code">
                            @foreach ($departments as $department)
                                <option value="{{ $department->department_code }}">
                                    {{ $department->department_name }}
                                </option>
                            @endforeach
                        </x-select>

                        <x-select name="employee_position_code" label="Vị trí" :selected="$employee->employee_position_code">
                            @foreach ($employeePositions as $position)
                                <option value="{{ $position->employee_position_code }}">
                                    {{ $position->position_name }}
                                </option>
                            @endforeach
                        </x-select>

                        <x-select name="specialized_code" label="Chuyên ngành" :selected="$employee->specialized_code">
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->specialized_code }}">
                                    {{ $specialization->specialized_name }}
                                </option>
                            @endforeach
                        </x-select>

                        <x-select name="education_level_code" label="Trình độ học vấn" :selected="$employee->education_level_code">
                            @foreach ($educationLevels as $level)
                                <option value="{{ $level->education_level_code }}">
                                    {{ $level->education_level_name }}
                                </option>
                            @endforeach
                        </x-select>

                        <x-select name="status" label="Trạng thái" :selected="$employee->status"
                            :options="[
                                ['label' => 'Đang làm việc', 'value' => 1],
                                ['label' => 'Ngừng làm việc', 'value' => 0]
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

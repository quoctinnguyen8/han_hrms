@extends('admin.layout.app')
@section('title', 'Thêm nhân viên mới')
@section('sidebar-key', 'admin.employee.list')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-input label="Mã nhân viên" name="employee_code" required />
                <x-input label="Tên đăng nhập" name="username" />
                <x-input label="Mật khẩu" name="password" type="password" />
                <x-input label="Nhập lại mật khẩu" name="password_confirmation" type="password" />
                <x-input label="Họ và tên" name="full_name" required />
                <x-input label="Ngày sinh" name="birthday" type="date" required />
                <x-input label="Quê quán" name="hometown" required />
                <x-input label="Số điện thoại" name="phone_number" required />
                <x-input label="CMND/CCCD" name="identity_card" />
                <div class="mb-3">
                    <label class="form-label">Giới tính</label>
                    <select class="form-select" name="gender">
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                </div>
                <x-input label="Dân tộc" name="ethnic" />
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="image" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Phòng ban</label>
                    <select class="form-select" name="department_code" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->department_code }}">
                                {{ $department->department_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Vị trí</label>
                    <select class="form-select" name="employee_position_code">
                        @foreach ($employeePositions as $position)
                            <option value="{{ $position->employee_position_code }}">
                                {{ $position->position_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại hợp đồng</label>
                    <select class="form-select" name="contract_code">
                        @foreach ($contracts as $contract)
                            <option value="{{ $contract->contract_code }}">
                                {{ $contract->contract_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Chuyên ngành</label>
                    <select class="form-select" name="specialized_code">
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization->specialized_code }}">
                                {{ $specialization->specialized_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Trình độ học vấn</label>
                    <select class="form-select" name="education_level_code">
                        @foreach ($educationLevels as $level)
                            <option value="{{ $level->education_level_code }}">
                                {{ $level->education_level_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status">
                        <option value="1">Đang làm việc</option>
                        <option value="0">Ngừng làm việc</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success" value="Thêm mới" />
        </div>
    </form>
@endsection

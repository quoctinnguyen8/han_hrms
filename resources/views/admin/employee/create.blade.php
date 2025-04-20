@extends('admin.layout.app')
@section('title', 'Thêm nhân viên mới')
@section('sidebar-key', 'admin.employee.list')

@section('content')
    <x-card>
        <form id="fCreateEmployee" novalidate action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-end mt-3">
                <input type="button" id="btnCreateEmployee" class="btn btn-success" value="Thêm mới" />
            </div>
            <ul class="nav nav-tabs nav-border-top" id="employeeTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Thông tin nhân viên</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contract-tab" data-bs-toggle="tab" data-bs-target="#contract" type="button" role="tab" aria-controls="contract" aria-selected="false">Thông tin hợp đồng</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="salary-tab" data-bs-toggle="tab" data-bs-target="#salary" type="button" role="tab" aria-controls="salary" aria-selected="false">Thông tin lương</button>
                </li>
            </ul>
            <div class="tab-content mt-3" id="employeeTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="row">
                        <h5 class="mb-3">Thông tin nhân viên</h5>
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
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ảnh đại diện</label>
                                <input type="file" class="form-control" name="image" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giới tính</label>
                                <select class="form-select" name="gender">
                                    <option value="" disabled {{ old('gender') === null ? 'selected' : '' }}>Chọn giới tính</option>
                                    <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Nam</option>
                                    <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>
                            <x-input label="Dân tộc" name="ethnic" :value="old('ethnic')" />
                            <div class="mb-3">
                                <label class="form-label">Phòng ban</label>
                                <select class="form-select" name="department_code" required>
                                    <option value="" disabled {{ old('department_code') === null ? 'selected' : '' }}>Chọn phòng ban</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->department_code }}" {{ old('department_code') == $department->department_code ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Vị trí</label>
                                <select class="form-select" name="employee_position_code">
                                    <option value="" disabled {{ old('employee_position_code') === null ? 'selected' : '' }}>Chọn vị trí</option>
                                    @foreach ($employeePositions as $position)
                                        <option value="{{ $position->employee_position_code }}" {{ old('employee_position_code') == $position->employee_position_code ? 'selected' : '' }}>
                                            {{ $position->position_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chuyên ngành</label>
                                <select class="form-select" name="specialized_code">
                                    <option value="" disabled {{ old('specialized_code') === null ? 'selected' : '' }}>Chọn chuyên ngành</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->specialized_code }}" {{ old('specialized_code') == $specialization->specialized_code ? 'selected' : '' }}>
                                            {{ $specialization->specialized_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trình độ học vấn</label>
                                <select class="form-select" name="education_level_code">
                                    <option value="" disabled {{ old('education_level_code') === null ? 'selected' : '' }}>Chọn trình độ học vấn</option>
                                    @foreach ($educationLevels as $level)
                                        <option value="{{ $level->education_level_code }}" {{ old('education_level_code') == $level->education_level_code ? 'selected' : '' }}>
                                            {{ $level->education_level_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" name="status">
                                    <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Chọn trạng thái</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Đang làm việc</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Ngừng làm việc</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="contract-tab">
                    <h5 class="mt-4">Thông tin hợp đồng</h5>
                    <div class="border p-3 mb-4 rounded">
                        <x-input label="Mã hợp đồng" name="contract_code" required />
                        <x-input label="Loại hợp đồng" name="contract_type" required />
                        <x-input label="Ngày bắt đầu" name="start_date" type="date" required />
                        <x-input label="Ngày kết thúc" name="end_date" type="date" required />
                        <div class="mb-3">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note" class="form-control" rows="3" placeholder="Ghi chú">{{ old('note') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">
                    <h5 class="mb-3">Thông tin lương</h5>
                    <div class="border p-3 mb-4 rounded">
                        <x-input label="Ngày trả lương" name="pay_day" type="date" />
                        <x-input label="Lương cơ bản" name="basic_salary" type="number" required />
                        <x-input label="Bảo hiểm xã hội" name="social_insurance" type="number" />
                        <x-input label="Bảo hiểm y tế" name="health_insurance" type="number" />
                        <x-input label="Bảo hiểm thất nghiệp" name="unemployment_insurance" type="number" />
                        <x-input label="Phụ cấp" name="allowance" type="number" />
                        <x-input label="Thuế thu nhập" name="income_tax" type="number" />
                        <x-input label="Tiền thưởng" name="bonus_money" type="number" />
                        <x-input label="Tiền phạt" name="discipline_money" type="number" />
                    </div>
                </div>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script src="{{ asset('js/admin-employee.js') }}"></script>
@endsection
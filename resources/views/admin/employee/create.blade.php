@extends('admin.layout.app')
@section('title', 'Thêm nhân viên mới')
@section('sidebar-key', 'admin.employee.list')

@section('content')
    <x-card>
        <form id="fCreateEmployee" novalidate action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-end mt-3">
                <input type="submit" class="btn btn-success" id="btnCreateEmployee" value="Thêm mới" />
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
                            <x-input label="Tên đăng nhập" name="username" placeholder="Tên đăng nhập sẽ được tạo tự động" disabled />
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

                            <x-select name="gender" label="Giới tính" :selected="old('gender')"
                                :options="['1' => 'Nam', '0' => 'Nữ']" required />

                            <x-input label="Dân tộc" name="ethnic" :selected="old('ethnic')" />

                            <x-select name="department_code" label="Phòng ban" model="Department" valueField="department_code" textField="department_name" :selected="old('department_code')" required />

                            <x-select name="employee_position_code" label="Vị trí" model="EmployeePosition" valueField="employee_position_code" textField="position_name" :selected="old('employee_position_code')" />

                            <x-select name="specialized_code" label="Chuyên ngành" model="Specialized" valueField="specialized_code" textField="specialized_name" :selected="old('specialized_code')" />

                            <x-select name="education_level_code" label="Trình độ học vấn" model="EducationLevel" valueField="education_level_code" textField="education_level_name" :selected="old('education_level_code')" />

                            <x-select name="status" id="e_status" label="Trạng thái" disabled :options="[
                                '1'=> 'Đang làm việc',
                                '0'=> 'Ngừng làm việc'
                            ]" :selected="old('status')" required />
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

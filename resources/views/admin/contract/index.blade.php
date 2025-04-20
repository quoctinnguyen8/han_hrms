@extends('admin.layout.app')
@section('title', 'Thông tin hợp đồng của nhân viên ' . get_employee_name($employeeCode))

{{-- menu focus vào trang danh sách nhân viên --}}
@section('sidebar-key', 'admin.employee.list')

@section('content')
    @include('admin._error')
    <x-card class="col-12">
        <x-employee-tab :employeeCode="$employeeCode" activeTab="contracts">
            <x-open-modal target="#mHopDongCreate" text="Thay đổi" />
            <x-table :headers="['Mã hợp đồng', 'Loại hợp đồng', 'Thời gian bắt đầu', 'Thời gian kết thúc']" :data="$contracts" key="contract_code">
                <x-slot:action>
                    <x-open-modal url="{{ route('admin.contracts.edit', ['contract' => ':id']) }}" text="Sửa"
                        icon="ri-edit-line" target="#mHopDongEdit" class="btn btn-warning btn-sm" />
                    <x-del-button url="{{ route('admin.contracts.destroy', ['contract' => ':id']) }}"
                        class="btn-danger btn-sm" />
                </x-slot>
            </x-table>
        </x-employee-tab>
    </x-card>
@endsection

@section('modal')
    <x-modal id="mHopDongCreate" title="Thay đổi hợp đồng và lương">
        <form action="{{ route('admin.contracts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="employee_code" value="{{ $employeeCode }}">

            <h5 class="mb-3">Thông tin hợp đồng</h5>
            <div class="border p-3 mb-4 rounded">
                <x-input label="Mã hợp đồng" name="contract_code" required />
                <x-input label="Loại hợp đồng" name="contract_type" required />
                <x-input label="Ngày bắt đầu" name="start_date" type="date" required />
                <x-input label="Ngày kết thúc" name="end_date" type="date" required />
                <div class="mb-3">
                    <label for="note">Ghi chú</label>
                    <textarea name="note" id="note" class="form-control" rows="3" placeholder="Ghi chú" >{{ old('note') }}</textarea>
                </div>
            </div>

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

            <div class="mb-3">
                <button type="submit" class="btn btn-success">
                    <i class="ri-save-line"></i> Thay đổi
                </button>
                <a href="{{ route('admin.contracts.index', ['employeeCode' => $employeeCode]) }}"
                    class="btn btn-light">Hủy</a>
            </div>
        </form>
    </x-modal>

    <x-modal id="mHopDongEdit" title="Sửa thông tin hợp đồng">
        {{-- Nội dung form sửa thông tin hợp đồng sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection

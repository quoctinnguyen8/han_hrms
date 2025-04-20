<form action="{{ route('admin.contracts.update', ['contract' => $contract->contract_code]) }}" method="POST">
    @csrf
    @method('PUT')

    <h5 class="mb-3">Thông tin hợp đồng</h5>
    <div class="border p-3 mb-4 rounded">
        <x-input :value="$contract->contract_code" label="Mã hợp đồng" name="contract_code" readonly />
        <x-input :value="$contract->contract_type" label="Loại hợp đồng" name="contract_type" readonly />
        <x-input :value="date_format($contract->start_date, 'Y-m-d')" label="Ngày bắt đầu" name="start_date" type="date" readonly />
        <x-input :value="date_format($contract->end_date, 'Y-m-d')" label="Ngày kết thúc" name="end_date" type="date" readonly />
        <textarea name="note" class="form-control" rows="3">{{ $contract->note }}</textarea>
    </div>
    <h5 class="mb-3">Thông tin lương</h5>
    <div class="border p-3 mb-4 rounded">
        <x-input :value="date_format($salaryDetail->pay_day, 'Y-m-d')" label="Ngày trả lương" name="pay_day" type="date" />
        <x-input :value="$salaryDetail->employee_code" label="Mã nhân viên" name="employee_code" readonly />
        <x-input :value="$salaryDetail->basic_salary" label="Lương cơ bản" name="basic_salary" type="number" required />
        <x-input :value="$salaryDetail->social_insurance" label="Bảo hiểm xã hội" name="social_insurance" type="number" />
        <x-input :value="$salaryDetail->health_insurance" label="Bảo hiểm y tế" name="health_insurance" type="number" />
        <x-input :value="$salaryDetail->unemployment_insurance" label="Bảo hiểm thất nghiệp" name="unemployment_insurance" type="number" />
        <x-input :value="$salaryDetail->allowance" label="Phụ cấp" name="allowance" type="number" />
        <x-input :value="$salaryDetail->income_tax" label="Thuế thu nhập" name="income_tax" type="number" />
        <x-input :value="$salaryDetail->discipline_money" label="Tiền phạt" name="discipline_money" type="number" />
        <x-input :value="$salaryDetail->bonus_money" label="Tiền thưởng" name="bonus_money" type="number" />
        <x-input :value="$salaryDetail->total_salary" label="Tổng lương" name="total_salary" type="number" readonly />
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>

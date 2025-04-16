<form action="{{ route('admin.bonuses.update', ['bonus' => $bonus->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <x-input-modal label="Nhân viên" value="{{get_employee_name($bonus->employee_code)}}" readonly />
    <x-input-modal label="Ngày thưởng" name="bonus_date" type="date" :value="date_format($bonus->bonus_date,'Y-m-d')" required />
    <x-input-modal label="Lý do thưởng" name="reason" :value="$bonus->reason" required />
    <x-input-modal label="Số tiền thưởng" name="bonus_money" type="number" :value="$bonus->bonus_money" required />

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
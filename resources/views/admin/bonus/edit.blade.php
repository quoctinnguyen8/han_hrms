<form action="{{ route('admin.bonuses.update', ['bonus' => $bonus->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="employee_code" value="{{ $bonus->employee_code }}">
    <x-input label="Ngày thưởng" name="bonus_date" type="date" :value="$bonus->bonus_date" required />
    <x-input label="Lý do thưởng" name="reason" :value="$bonus->reason" required />
    <x-input label="Số tiền thưởng" name="bonus_money" type="number" :value="$bonus->bonus_money" required />

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
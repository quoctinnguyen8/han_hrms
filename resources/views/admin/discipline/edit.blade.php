<form action="{{ route('admin.disciplines.update', ['discipline' => $discipline->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <x-input-modal label="Nhân viên" value="{{ get_employee_name($discipline->employee_code) }}" readonly />
    <x-input-modal label="Ngày kỷ luật" name="discipline_date" type="date" :value="date_format($discipline->discipline_date, 'Y-m-d')" required />
    <x-input-modal label="Lý do" name="reason" :value="$discipline->reason" required />
    <x-input-modal label="Tiền phạt" name="discipline_money" type="number" :value="$discipline->discipline_money" required />

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
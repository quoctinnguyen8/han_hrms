<form action="{{ route('admin.disciplines.update', ['discipline' => $discipline->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="employee_code" value="{{ $discipline->employee_code }}">
    <x-input label="Ngày kỷ luật" name="discipline_date" type="date" :value="$discipline->discipline_date" required />
    <x-input label="Lý do" name="reason" :value="$discipline->reason" required />
    <x-input label="Tiền phạt" name="discipline_money" type="number" :value="$discipline->discipline_money" required />

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
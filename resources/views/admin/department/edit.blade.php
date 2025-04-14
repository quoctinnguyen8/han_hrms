<form action="{{ route('admin.departments.update', ['department'=>$department->department_code]) }}" method="POST">
    @csrf
    @method('PUT')
    <x-input-modal :value="$department->department_code" readonly label="Mã phòng ban" name="department_code" required />
    <x-input-modal :value="$department->department_name" label="Tên phòng ban" name="department_name" required />
    <x-input-modal :value="$department->address" label="Địa chỉ" name="address" />
    <x-input-modal :value="$department->phone_number" label="Số điện thoại" name="phone_number" />

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
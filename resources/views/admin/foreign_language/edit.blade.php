<form action="{{ route('admin.foreign_languages.update', ['foreign_language'=>$foreignLanguage->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <x-input-modal label="Nhân viên" value="{{get_employee_name($foreignLanguage->employee_code)}}" readonly />
    <x-input-modal :value="$foreignLanguage->foreign_language_name" label="Tên ngoại ngữ" name="foreign_language_name" required />
    <x-input-modal :value="$foreignLanguage->level" label="Trình độ" name="level" required />

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
<form action="{{ route('admin.after_universities.update', ['after_university'=>$afterUniversity->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <x-input-modal label="Nhân viên" value="{{get_employee_name($afterUniversity->employee_code)}}" readonly />
    <x-input-modal :value="$afterUniversity->specialized_master" label="Chuyên ngành thạc sĩ" name="specialized_master" required />
    <x-input-modal :value="$afterUniversity->training_place_master" label="Nơi đào tạo thạc sĩ" name="training_place_master" required />
    <x-input-modal :value="$afterUniversity->degree_year_master" label="Năm nhận bằng thạc sĩ" name="degree_year_master" type="number" required />

    <x-input-modal :value="$afterUniversity->specialized_doctorate" label="Chuyên ngành tiến sĩ" name="specialized_doctorate" />
    <x-input-modal :value="$afterUniversity->training_place_doctorate" label="Nơi đào tạo tiến sĩ" name="training_place_doctorate" />
    <x-input-modal :value="$afterUniversity->degree_year_doctorate" label="Năm nhận bằng tiến sĩ" name="degree_year_doctorate" type="number" />

    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
<form action="{{ route('admin.management.update', ['management' => $admin->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <x-input :value="$admin->username" label="Tên tài khoản" name="username" required />
    <x-input label="Mật khẩu mới" name="password" type="password" placeholder="Để trống nếu không thay đổi" />
    <x-input label="Nhập lại mật khẩu mới" name="password_confirmation" type="password" placeholder="Để trống nếu không thay đổi" />
    <div class="mb-3">
        <input type="checkbox" id="is_account_mnt" name="is_account_mnt" value="1" {{ $admin->is_account_mnt ? 'checked' : '' }}>
        <label for="is_account_mnt" class="form-label">Quyền thêm/sửa/xóa tài khoản admin</label>
    </div>
    <div class="mb-3">
        <input type="checkbox" id="is_del_empl" name="is_del_empl" value="1" {{ $admin->is_del_empl ? 'checked' : '' }}>
        <label for="is_del_empl" class="form-label">Quyền xóa thông tin nhân viên</label>
    </div>
    <div class="mb-3">
        <input type="checkbox" id="is_quit_job_mnt" name="is_quit_job_mnt" value="1" {{ $admin->is_quit_job_mnt ? 'checked' : '' }}>
        <label for="is_quit_job_mnt" class="form-label">Quyền tạo thông tin nghỉ việc cho nhân viên</label>
    </div>
    <div class="mb-3">
        <input type="checkbox" id="is_leave_mnt" name="is_leave_mnt" value="1" {{ $admin->is_leave_mnt ? 'checked' : '' }}>
        <label for="is_leave_mnt" class="form-label">Quyền quản lý thông tin nghỉ phép toàn công ty</label>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Cập nhật" />
    </div>
</form>
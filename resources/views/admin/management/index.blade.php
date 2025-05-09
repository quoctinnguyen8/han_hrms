@extends('admin.layout.app')
@section('title', 'Danh sách Admin')
@section('sidebar-key', 'admin.management.list')

@section('content')

    <x-card class="col-12">
        <div class="mb-3">
            <x-open-modal target="#mAdminCreate" />
        </div>
       <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Mã Admin</th>
                    <th>Tên tài khoản</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($adminList as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->username }}</td>
                        <td class="text-center">
                            <x-open-modal url="{{ route('admin.management.edit', ['management' => $admin->id]) }}" text="chi tiết" icon="ri-edit-line" target="#mAdminEdit" class="btn btn-success btn-sm" />
                            <x-del-button url="{{ route('admin.management.destroy', ['management' => $admin->id]) }}" class="btn-danger btn-sm" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $adminList->links() }}
    </x-card>

@endsection

@section('modal')
    <x-modal id="mAdminCreate" title="Thêm Admin">
        <form action="{{ route('admin.management.store') }}" method="POST">
            @csrf
            <x-input-modal label="Tên tài khoản" name="username" required />
            <x-input-modal label="Mật khẩu" name="password" type="password" required />
            <x-input-modal label="Nhập lại mật khẩu" name="password_confirmation" type="password" required />
            <div class="mb-3">
                <input type="checkbox" id="is_account_mnt" name="is_account_mnt" value="1">
                <label for="is_account_mnt" class="form-label">Quyền thêm/sửa/xóa tài khoản admin</label>
            </div>
            <div class="mb-3">
                <input type="checkbox" id="is_del_empl" name="is_del_empl" value="1">
                <label for="is_del_empl" class="form-label">Quyền xóa thông tin nhân viên</label>
            </div>
            <div class="mb-3">
                <input type="checkbox" id="is_quit_job_mnt" name="is_quit_job_mnt" value="1">
                <label for="is_quit_job_mnt" class="form-label">Quyền tạo thông tin nghỉ việc cho nhân viên</label>
            </div>
            <div class="mb-3">
                <input type="checkbox" id="is_leave_mnt" name="is_leave_mnt" value="1">
                <label for="is_leave_mnt" class="form-label">Quyền quản lý thông tin nghỉ phép toàn công ty</label>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Thêm mới" />
            </div>
        </form>
    </x-modal>

    <x-modal id="mAdminEdit" title="Sửa thông tin Admin">
        {{-- Nội dung form sửa thông tin Admin sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
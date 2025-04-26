@extends('admin.layout.app')
@section('title', 'Đổi mật khẩu')
@section('sidebar-key', 'admin.employee.list')


@section('content')
    @include('admin._error')
    <x-card class="col-md-4 m-auto">
        <form action="{{ route('admin.changePassword') }}" method="POST">
            @csrf
            <x-input label="Mật khẩu cũ" name="current_password" type="password" required />
            <x-input label="Mật khẩu mới" name="new_password" type="password" required />
            <x-input label="Nhập lại mật khẩu mới" name="new_password_confirmation" type="password" required />
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
            </div>
        </form>
    </x-card>
@endsection

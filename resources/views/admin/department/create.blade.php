@extends('admin.layout.app')
@section('title', 'Sửa phòng ban')
@section('content')
    <x-card title="Sửa phòng ban">
        <form action="{{ route('admin.department.update') }}" method="POST">
            @csrf
            <x-app-input value="{{ $data->department_code }}" label="Mã phòng ban" name="department_code" />
            <x-app-input value="{{ $data->department_name }}" label="Tên phòng ban" name="department_name" />
            <x-app-input value="{{ $data->address }}" label="Địa chỉ" name="address" />
            <x-app-input value="{{ $data->department_phone_number }}" label="Số điện thoại" name="department_phone_number" />
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </x-card>
@endsection

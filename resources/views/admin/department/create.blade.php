@extends('admin.layout.app')
@section('title', 'Thêm phòng ban')
@section('content')
    <x-card title="Thêm phòng ban">
        <form action="{{ route('admin.department.store') }}" method="POST">
            @csrf
            <x-app-input label="Mã phòng ban" name="department_code" />
            <x-app-input label="Tên phòng ban" name="department_name" />
            <x-app-input label="Địa chỉ" name="address" />
            <x-app-input label="Số điện thoại" name="department_phone_number" />
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </x-card>
@endsection

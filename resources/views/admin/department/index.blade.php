@extends('admin.layout.app')
@section('title', 'Danh sách phòng ban')
@section('content')
    <x-card title="Danh sách phòng ban">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mCreate">
            Thêm phòng ban
        </button>

        <table>
            
        </table>

        <x-modal id="mCreate" title="Thêm phòng ban">
            <form action="{{ route('admin.department.store') }}" method="POST">
                @csrf
                <x-app-input label="Mã phòng ban" name="department_code" />
                <x-app-input label="Tên phòng ban" name="department_name" />
                <x-app-input label="Địa chỉ" name="address" />
                <x-app-input label="Số điện thoại" name="department_phone_number" />
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </x-modal>
    </x-card>
@endsection

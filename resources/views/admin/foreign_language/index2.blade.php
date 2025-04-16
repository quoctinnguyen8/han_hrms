@extends('admin.layout.app')
@section('title', 'Thông tin ngoại ngữ')

@section('sidebar-key', 'admin.foreign_language.list')

@section('content')
    <x-card class="col-12">
        <p class="mt-3 fst-italic">Thêm thông tin ngoại ngữ từ tab Ngoại ngữ của nhân viên</p>
        <x-table :headers="['ID', 'Mã nhân viên', 'Tên nhân viên', 'Tên ngoại ngữ', 'Trình độ']" :data="$foreignLanguages" key="id">
            <x-slot:action>
                <x-open-modal url="{{ route('admin.foreign_languages.edit', ['foreign_language' => ':id']) }}"
                    text="Sửa" icon="ri-edit-line" target="#mNgoaiNguEdit" class="btn btn-warning btn-sm" />
                <x-del-button url="{{ route('admin.foreign_languages.destroy', ['foreign_language' => ':id']) }}"
                    class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $foreignLanguages->links() }}
    </x-card>
@endsection

@section('modal')
    <x-modal id="mNgoaiNguEdit" title="Sửa thông tin ngoại ngữ">
        {{-- Nội dung form sửa thông tin ngoại ngữ sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
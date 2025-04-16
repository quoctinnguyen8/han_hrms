@extends('admin.layout.app')
@section('title', 'Công trình khoa học')

@section('sidebar-key', 'admin.scientific_work.list')

@section('content')
    @include('admin._error')
    <x-card class="col-12">
        <p class="mt-3 fst-italic">Thêm thông tin công trình khoa học từ tab Công trình khoa học của nhân viên</p>
        <x-table :headers="['ID', 'Mã NV', 'Tên NV', 'Tên công trình khoa học', 'Năm', 'Tên tạp chí']" :data="$scientificWorks" key="id">
            <x-slot:action>
                <x-open-modal url="{{ route('admin.scientific_works.edit', ['scientific_work' => ':id']) }}"
                    text="Sửa" icon="ri-edit-line" target="#mCongTrinhEdit" class="btn btn-warning btn-sm" />
                <x-del-button url="{{ route('admin.scientific_works.destroy', ['scientific_work' => ':id']) }}"
                    class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $scientificWorks->links() }}
    </x-card>
@endsection

@section('modal')
    <x-modal id="mCongTrinhEdit" title="Sửa thông tin công trình khoa học">
        {{-- Nội dung form sửa thông tin công trình khoa học sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
@extends('admin.layout.app')
@section('title', 'Danh sách kỷ luật')

@section('sidebar-key', 'admin.discipline.list')

@section('content')
    @include('admin._error')
    <x-card class="col-12">
        <p class="mt-3 fst-italic">Thêm thông tin kỷ luật từ tab Kỷ luật của nhân viên</p>
        <x-table :headers="['ID', 'Mã nhân viên', 'Tên nhân viên', 'Ngày kỷ luật', 'Lý do', 'Tiền phạt']" :data="$disciplines" key="id">
            <x-slot:action>
                <x-open-modal url="{{ route('admin.disciplines.edit', ['discipline' => ':id']) }}"
                    text="Sửa" icon="ri-edit-line" target="#mKyLuatEdit" class="btn btn-warning btn-sm" />
                <x-del-button url="{{ route('admin.disciplines.destroy', ['discipline' => ':id']) }}"
                    class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $disciplines->links() }}
    </x-card>
@endsection

@section('modal')
    <x-modal id="mKyLuatEdit" title="Sửa thông tin kỷ luật">
        {{-- Nội dung form sửa thông tin kỷ luật sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
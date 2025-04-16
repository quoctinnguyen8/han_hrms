@extends('admin.layout.app')
@section('title',  'Danh sách khen thưởng')

@section('sidebar-key', 'admin.bonus.list')

@section('content')
    @include('admin._error')
    <x-card class="col-12">
        <p class="mt-3 fst-italic">Thêm thông tin khen thưởng từ tab Khen thưởng của nhân viên</p>
        <x-table :headers="['ID', 'Mã nhân viên', 'Tên nhân viên', 'Ngày thưởng', 'Lý do thưởng', 'Số tiền thưởng']" :data="$bonuses" key="id">
            <x-slot:action>
                <x-open-modal url="{{ route('admin.bonuses.edit', ['bonus' => ':id']) }}"
                    text="Sửa" icon="ri-edit-line" target="#mKhenThuongEdit" class="btn btn-warning btn-sm" />
                <x-del-button url="{{ route('admin.bonuses.destroy', ['bonus' => ':id']) }}"
                    class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $bonuses->links() }}
    </x-card>
@endsection

@section('modal')
    <x-modal id="mKhenThuongEdit" title="Sửa thông tin khen thưởng">
        {{-- Nội dung form sửa thông tin khen thưởng sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection

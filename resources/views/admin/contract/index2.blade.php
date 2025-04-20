# filepath: c:\Users\phamt\OneDrive\Máy tính\Github\HRNs\resources\views\admin\contract\index2.blade.php
@extends('admin.layout.app')
@section('title', 'Danh sách hợp đồng')

@section('sidebar-key', 'admin.contract.list')

@section('content')
    <x-card class="col-12">
        <p class="mt-3 fst-italic">Xem danh sách tất cả hợp đồng trong hệ thống</p>
        <x-table :headers="['Mã hợp đồng','Loại hợp đồng', 'Thời gian bắt đầu', 'Thời gian kết thúc']" :data="$contracts" key="contract_code">
            <x-slot:action>
                <x-open-modal url="{{ route('admin.contracts.edit', ['contract' => ':id']) }}"
                    text="Sửa" icon="ri-edit-line" target="#mHopDongEdit" class="btn btn-warning btn-sm" />
                <x-del-button url="{{ route('admin.contracts.destroy', ['contract' => ':id']) }}"
                    class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $contracts->links() }}
    </x-card>
@endsection

@section('modal')
    <x-modal id="mHopDongEdit" title="Sửa thông tin hợp đồng">
        {{-- Nội dung form sửa thông tin hợp đồng sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
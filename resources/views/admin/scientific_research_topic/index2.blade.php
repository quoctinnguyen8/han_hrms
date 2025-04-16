@extends('admin.layout.app')
@section('title', 'Đề tài nghiên cứu khoa học')

@section('sidebar-key', 'admin.scientific_research_topic.list')

@section('content')
    @include('admin._error')
    <x-card class="col-12">
        <p class="mt-3 fst-italic">Thêm thông tin đề tài nghiên cứu khoa học từ tab Nghiên cứu khoa học của nhân viên</p>
        <x-table :headers="['ID', 'Mã NV', 'Tên NV','Tên đề tài', 'Năm bắt đầu', 'Năm kết thúc', 'Cấp đề tài', 'Vai trò']" :data="$scientificResearchTopics" key="id">
            <x-slot:action>
                <x-open-modal url="{{ route('admin.scientific_research_topics.edit', ['scientific_research_topic' => ':id']) }}"
                    text="Sửa" icon="ri-edit-line" target="#mDeTaiEdit" class="btn btn-warning btn-sm" />
                <x-del-button url="{{ route('admin.scientific_research_topics.destroy', ['scientific_research_topic' => ':id']) }}"
                    class="btn-danger btn-sm" />
            </x-slot>
        </x-table>
        {{ $scientificResearchTopics->links() }}
    </x-card>
@endsection

@section('modal')
    <x-modal id="mDeTaiEdit" title="Sửa thông tin đề tài nghiên cứu khoa học">
        {{-- Nội dung form sửa thông tin đề tài sẽ được load vào đây (từ file edit.blade.php) --}}
    </x-modal>
@endsection
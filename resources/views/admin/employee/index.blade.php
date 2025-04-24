@extends('admin.layout.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Danh sách nhân viên</h3>

        <!-- Form tìm kiếm -->
        <form method="GET" class="form-inline">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <x-table :headers="['Mã NV', 'Tên NV', 'Quê quán', 'SĐT', 'Phòng ban', 'Trạng thái', 'Ngày tạo', 'Người tạo']">
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->employee_code }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->hometown ?? 'N/A' }}</td>
                    <td>{{ $employee->phone_number ?? 'N/A' }}</td>
                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $employee->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $employee->status ? 'Đang làm việc' : 'Đã nghỉ' }}
                        </span>
                    </td>
                    <td>{{ optional($employee->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
                    <td>{{ $employee->created_by ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Không có nhân viên nào</td>
                </tr>
            @endforelse
        </x-table>

        <!-- Phân trang -->
        @if($employees->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $employees->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

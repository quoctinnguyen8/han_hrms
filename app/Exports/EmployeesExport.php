<?php

namespace App\Exports;

use App\Models\Employee; // Đảm bảo model Employee được import
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping; // Thêm cái này nếu bạn muốn tùy chỉnh dữ liệu từng hàng

class EmployeesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Lấy thông tin nhân viên kèm tên phòng ban và chức vụ từ bảng liên kết
        return Employee::with(['department', 'employee_position'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Định nghĩa tiêu đề cho các cột
        return [
            'Mã nhân viên',
            'Họ và tên',
            'Ngày sinh',
            'Giới tính',
            'Số điện thoại',
            'Quê quán',
            'Phòng ban',
            'Chức vụ',
            'Số CCCD/CMND',
            'Dân tộc',
        ];
    }

    /**
     * @param mixed $employee
     * @return array
     */
    public function map($employee): array
    {
        // Tùy chỉnh dữ liệu cho từng hàng
        // Ví dụ: chuyển đổi giá trị gender từ số sang chữ
        return [
            $employee->employee_code,
            $employee->full_name,
            $employee->birthday ? $employee->birthday->format('d/m/Y') : '', // Định dạng ngày tháng
            $employee->gender == 1 ? 'Nam' : ($employee->gender == 0 ? 'Nữ' : 'Khác'),
            $employee->phone_number,
            $employee->hometown,
            $employee->department->department_name,
            $employee->employee_position->position_name,
            $employee->identity_card,
            $employee->ethnic,
        ];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EducationLevel; // Thêm cho báo cáo 2
use App\Models\Specialized; // Thêm cho báo cáo 3
use App\Models\Contract; // Thêm cho báo cáo 4
use App\Models\Bonus; // Thêm cho báo cáo 7
use App\Models\Discipline; // Thêm cho báo cáo 7
use App\Models\ScientificResearchTopic; // Thêm cho báo cáo 8
use App\Models\ScientificWork; // Thêm cho báo cáo 8
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    //thống kê số lượng nhân viên theo phòng ban
    public function employeesByDepartment()
    {
        $departmentsData = Department::withCount('employees')
            ->orderBy('department_name')
            ->get();

        $labels = $departmentsData->pluck('department_name');
        $data = $departmentsData->pluck('employees_count');

        return view('admin.report.employees-by-department', compact('labels', 'data'));
    }

    //thống kê số lượng nhân viên theo trình độ học vấn
    public function employeesByEducationLevel()
    {
        $educationData = EducationLevel::withCount('employees')
            ->orderBy('education_level_name') // Hoặc một trường thứ tự khác nếu có
            ->get();

        $labels = $educationData->pluck('education_level_name');
        $data = $educationData->pluck('employees_count');

        return view('admin.report.employees_by_edulevel', compact('labels', 'data'));
    }

    //thống kê số lượng nhân viên theo chuyên ngành
    public function employeesBySpecialization()
    {
        $specializationData = Specialized::withCount('employees')
            ->orderBy('specialized_name') // Hoặc một trường thứ tự khác nếu có
            ->get();

        $labels = $specializationData->pluck('specialized_name');
        $data = $specializationData->pluck('employees_count');

        return view('admin.report.employees_by_spec', compact('labels', 'data'));
    }

    //thống kê số lượng nhân viên theo loại hợp đồng
    public function employeeContract()
    {
        $contractData = Contract::query()
            ->select('contract_type', DB::raw('COUNT(DISTINCT employee_code) as employees_count'))
            ->groupBy('contract_type')
            ->orderBy('contract_type') // Sửa: sử dụng cột 'contract_type'
            ->get();

        $labels = $contractData->pluck('contract_type'); // Sửa: sử dụng cột 'contract_type'
        $data = $contractData->pluck('employees_count');

        return view(
            'admin.report.employees_by_contract',
            compact('labels', 'data', 'contractData')
        );
    }

    //Thống kê nhân viên theo thâm niên
    public function employeeSeniority()
    {
        $employees = Employee::with(['contract' => function ($query) {
            $query->orderBy('start_date', 'asc');
        }])->get();

        $seniorityGroups = [
            '0-1 năm' => 0,
            '1-3 năm' => 0,
            '3-5 năm' => 0,
            '5-10 năm' => 0,
            '> 10 năm' => 0,
        ];

        foreach ($employees as $employee) {
            if ($employee->contract->isNotEmpty()) {
                $firstContractStartDate = Carbon::parse($employee->contract->first()->start_date);
                $yearsOfService = $firstContractStartDate->diffInYears(Carbon::now());

                if ($yearsOfService < 1) {
                    $seniorityGroups['0-1 năm']++;
                } elseif ($yearsOfService < 3) {
                    $seniorityGroups['1-3 năm']++;
                } elseif ($yearsOfService < 5) {
                    $seniorityGroups['3-5 năm']++;
                } elseif ($yearsOfService < 10) {
                    $seniorityGroups['5-10 năm']++;
                } else {
                    $seniorityGroups['> 10 năm']++;
                }
            }
        }

        $labels = array_keys($seniorityGroups);
        $data = array_values($seniorityGroups);

        return view('admin.report.employee_seniority', compact('labels', 'data'));
    }

    //Thống kê đề tài nghiên cứu / bài báo khoa học
    public function researchByYear(Request $request)
    {
        $startYearInput = $request->input('start_year', Carbon::now()->subYears(4)->year);
        $endYearInput = $request->input('end_year', Carbon::now()->year);

        // Đảm bảo startYear không lớn hơn endYear
        $startYear = min((int)$startYearInput, (int)$endYearInput);
        $endYear = max((int)$startYearInput, (int)$endYearInput);

        $currentYear = Carbon::now()->year;
        // Tạo danh sách các năm có sẵn cho bộ lọc, ví dụ 10 năm gần nhất
        $availableYears = range($currentYear, $currentYear - 9);

        $yearsRange = range($startYear, $endYear);
        $labels = $yearsRange;

        $topicCounts = [];
        $workCounts = [];

        foreach ($yearsRange as $year) {

            $topicCounts[$year] = ScientificResearchTopic::where('year_of_complete', (string)$year)->count();
            $workCounts[$year] = 0; // Placeholder, cập nhật khi có thông tin model ScientificWork
        }

        $dataTopics = array_values($topicCounts);
        $dataWorks = array_values($workCounts);

        return view('admin.report.research_by_year', compact(
            'labels',
            'dataTopics',
            'dataWorks',
            'startYear',
            'endYear',
            'availableYears',
            'currentYear',
            'topicCounts',
            'workCounts'
        ));
    }

    //Khen thưởng / Kỷ luật theo năm
    public function bonusDisciplineByYear(Request $request)
    {
        $currentYear = Carbon::now()->year;
        // Lấy 5 năm gần nhất bao gồm năm hiện tại
        $availableYears = range($currentYear, $currentYear - 4);
        $selectedYear = $request->input('year', $currentYear);

        // Sử dụng cột 'bonus_date' từ model Bonus
        $bonusData = Bonus::whereYear('bonus_date', $selectedYear)
            ->selectRaw('MONTH(bonus_date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')->all();

        // Sử dụng cột 'discipline_date' từ model Discipline
        $disciplineData = Discipline::whereYear('discipline_date', $selectedYear)
            ->selectRaw('MONTH(discipline_date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')->all();

        $labels = [];
        $bonusCounts = [];
        $disciplineCounts = [];

        for ($m = 1; $m <= 12; $m++) {
            $labels[] = 'Tháng ' . $m;
            $bonusCounts[] = $bonusData[$m] ?? 0;
            $disciplineCounts[] = $disciplineData[$m] ?? 0;
        }

        return view('admin.report.bonusdiscipline_by_year', compact('labels', 'bonusCounts', 'disciplineCounts', 'selectedYear', 'availableYears', 'currentYear'));
    }
}

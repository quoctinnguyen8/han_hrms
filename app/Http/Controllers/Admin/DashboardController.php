<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends BaseController
{
    public function index()
    {

        $results = DB::table('departments')
            ->leftJoin('employees', 'departments.department_code', '=', 'employees.department_code')
            ->select('departments.department_name', DB::raw('COUNT(employees.employee_code) as total'))
            ->groupBy('departments.department_name')
            ->get();

        $departments = $results->pluck('department_name');
        $employeeCounts = $results->pluck('total');

        return view('admin.dashboard.index', compact('departments', 'employeeCounts'));

        //return view('admin.dashboard.index');
    }

    // export employee data to excel using Maatwebsite Excel package
    // https://docs.laravel-excel.com/3.1/getting-started
    public function exportExcel()
    {
        $filename = 'employees_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new \App\Exports\EmployeesExport, $filename);
    }
}

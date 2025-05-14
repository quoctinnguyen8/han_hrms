<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::paginate();
        return view('admin.department.index', compact('departments'));
    }
    public function create()
    {
        return view('admin.department.create');
    }
    public function store(Request $request)
    {
        $fields = [
            'department_code' => 'Mã phòng ban',
            'department_name' => 'Tên phòng ban',
            'address' => 'Địa chỉ',
            'department_phone_number' => 'Số điện thoại phòng ban',
        ];
        $data = $request->validate([
            'department_code' => 'required|unique:departments,department_code',
            'department_name' => 'required',
            'address' => 'nullable',
            'department_phone_number' => 'nullable|regex:/^0[0-9]{9}$/',
        ], [], $fields);

        Department::create($data);

        return redirect()
            ->route('admin.department.index')
            ->with('success', 'Department created successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::paginate();
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = [
            'department_code' => 'Mã phòng ban',
            'department_name' => 'Tên phòng ban',
            'address' => 'Địa chỉ',
            'department_phone_number' => 'Số điện thoại phòng ban',
        ];
        $validatedData = $request->validate([
            'department_code' => 'required|string|unique:departments,department_code',
            'department_name' => 'required|string',
            'address' => 'nullable|string',
            'department_phone_number' => 'nullable|string',
        ], [], $fields);

        $department = Department::create($validatedData);
        // quay về trang danh sách phòng ban
        return redirect()->route('admin.departments.index')->with('success', 'Thêm phòng ban thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        return view('admin.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::findOrFail($id);

        $validatedData = $request->validate([
            'department_name' => 'required|string',
            'address' => 'nullable|string',
            'department_phone_number' => 'nullable|string',
        ]);

        $department->update($validatedData);
        return redirect()
                ->route('admin.departments.index')
                ->with('success', 'Cập nhật phòng ban thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        // Kiểm tra xem phòng ban có nhân viên nào không
        if ($department->employees()->count() > 0) {
            return redirect()
                    ->route('admin.departments.index')
                    ->with('error', 'Không thể xóa vì phòng ban này có thông tin nhân viên');
        }
        // Xóa phòng ban
        $department->delete();
        return redirect()
                ->route('admin.departments.index')
                ->with('success', 'Xóa phòng ban '.$department->department_name.' thành công');
    }

    private function validateDepartment(Request $request)
    {
        return $request->validate([
            'department_code' => 'required|string|unique:departments,department_code',
            'department_name' => 'required|string',
            'address' => 'nullable|string',
            'department_phone_number' => 'nullable|string',
        ]);
    }
}

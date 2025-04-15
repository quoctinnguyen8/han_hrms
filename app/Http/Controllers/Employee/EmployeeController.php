<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Department;
use App\Models\EducationLevel;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\Specialized;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $employees = Employee::select(
            'employee_code',
            'full_name',
            'hometown',
            'phone_number'
        )->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $employeePositions = EmployeePosition::all();
        $contracts = Contract::all();
        $specializations = Specialized::all();
        $educationLevels = EducationLevel::all();

        return view('employee.create', compact(
            'departments',
            'employeePositions',
            'contracts',
            'specializations',
            'educationLevels'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'employee_code' => 'required|string|max:20|unique:employees,employee_code',
            'username' => 'nullable|unique:employees,username',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'full_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'hometown' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'identity_card' => 'nullable|string|max:20',
            'gender' => 'required|boolean',
            'ethnic' => 'required|string|max:50',
            'department_code' => 'required|exists:departments,department_code',
            'employee_position_code' => 'required|exists:employee_positions,employee_position_code',
            'contract_code' => 'required|exists:contracts,contract_code',
            'specialized_code' => 'required|exists:specialized,specialized_code',
            'education_level_code' => 'required|exists:education_levels,education_level_code',
            'status' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $validated['password'] = bcrypt($request->password);
        $img = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->image->move(public_path('images/employees'), $img);
        $validated['image'] = 'images/employees/' . $img;
        Employee::create($validated);
        return redirect()->route('admin.employee.index')
            ->with('success', 'Nhân viên đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $employeePositions = EmployeePosition::all();
        $contracts = Contract::all();
        $specializations = Specialized::all();
        $educationLevels = EducationLevel::all();

        return view('employee.edit', compact(
            'employee',
            'departments',
            'employeePositions',
            'contracts',
            'specializations',
            'educationLevels'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $rules = [
            'username' => 'required',
            'full_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'hometown' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'identity_card' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'gender' => 'required|boolean',
            'ethnic' => 'required|string|max:50',
            'department_code' => 'required|exists:departments,department_code',
            'employee_position_code' => 'required|exists:employee_positions,employee_position_code',
            'contract_code' => 'required|exists:contracts,contract_code',
            'specialized_code' => 'required|exists:specialized,specialized_code',
            'education_level_code' => 'required|exists:education_levels,education_level_code',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }
        $validated = $request->validate($rules);
        if (!$request->filled('password')) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }
        if ($request->hasFile('image')) {
            if ($employee->image) {
                unlink(public_path($employee->image));
            }
            $img = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/employees'), $img);
            $validated['image'] = 'images/employees/' . $img;
        } else {
            unset($validated['image']);
        }
        $employee->update($validated);
        return redirect()->route('admin.employee.index')
            ->with('success', 'Thông tin nhân viên đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        if($employee->image) { 
            unlink(public_path($employee->image));
        }
        $employee->delete();
        return redirect()->route('admin.employee.index')
            ->with('success', 'Nhân viên đã được xóa thành công');
    }
}

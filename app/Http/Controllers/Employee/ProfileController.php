<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Employee;

class ProfileController extends Controller
{
    private $employee;
    public function __construct()
    {
        $this->employee = Auth::guard('employee')->user();
    }
    public function detail()
    {
        $employee_code = $this->employee->employee_code;
        $user = Employee::find($employee_code);
        return view('employee.profile.detail', compact('user'));
    }
    public function edit()
    {
        $employee = Auth::guard('employee')->user();
        $user = Employee::find($employee->employee_code);
        return view('employee.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('employee')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($user->id),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('employees')->ignore($user->id),
            ],
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
}

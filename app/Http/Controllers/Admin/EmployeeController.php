<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Department;
use App\Models\EducationLevel;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\SalaryDetail;
use App\Models\Specialized;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{

    private $fields = [
        'contract_code' => 'Mã hợp đồng',
        'employee_code' => 'Mã nhân viên',
        'contract_type' => 'Loại hợp đồng',
        'start_date' => 'Ngày bắt đầu',
        'end_date' => 'Ngày kết thúc',
        'note' => 'Ghi chú',
        'basic_salary' => 'Lương cơ bản',
        'social_insurance' => 'Bảo hiểm xã hội',
        'health_insurance' => 'Bảo hiểm y tế',
        'unemployment_insurance' => 'Bảo hiểm thất nghiệp',
        'allowance' => 'Phụ cấp',
        'income_tax' => 'Thuế thu nhập cá nhân',
        'bonus_money' => 'Tiền thưởng',
        'pay_day' => 'Ngày trả lương',
        'discipline_money' => 'Tiền kỷ luật',
        'username' => 'Tên đăng nhập',
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'full_name' => 'Họ và tên',
        'birthday' => 'Ngày sinh',
        'hometown' => 'Quê quán',
        'phone_number' => 'Số điện thoại',
        'identity_card' => 'Số CMND/CCCD',
        'gender' => 'Giới tính',
        'ethnic' => 'Dân tộc',
        'department_code' => 'Mã phòng ban',
        'employee_position_code' => 'Mã chức vụ',
    ];

    private $rules = [
        'employee_code' => 'required|string|max:20|unique:employees,employee_code',
        'username' => 'nullable|unique:employees,username|string|max:20',
        'password' => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required|string|min:8',
        'full_name' => 'required|string|max:40',
        'birthday' => 'required|date',
        'hometown' => 'required|string|max:90',
        'phone_number' => 'required|string|max:11',
        'identity_card' => 'nullable|string|max:50',
        'gender' => 'required|boolean',
        'ethnic' => 'required|string|max:10',
        'department_code' => 'required|exists:departments,department_code',
        'employee_position_code' => 'required|exists:employee_positions,employee_position_code',
        'contract_code' => 'required|unique:contracts',
        'specialized_code' => 'required|exists:specialized,specialized_code',
        'education_level_code' => 'required|exists:education_levels,education_level_code',
        'status' => 'required|boolean',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'contract_type' => 'required|string',
        'start_date' => 'required|date|before_or_equal:end_date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date|after_or_equal:today',
        'note' => 'nullable|string|max:500',
        'basic_salary' => 'required|numeric|min:1|max:99999999999',
        'social_insurance' => 'required|numeric|min:1|max:99999999999',
        'health_insurance' => 'required|numeric|min:1|max:99999999999',
        'unemployment_insurance' => 'required|numeric|min:1|max:99999999999',
        'allowance' => 'required|numeric|min:1|max:99999999999',
        'income_tax' => 'required|numeric|min:1|max:99999999999',
        'bonus_money' => 'nullable|numeric|min:1|max:99999999999',
        'discipline_money' => 'nullable|numeric|min:1|max:99999999999',
        'pay_day' => 'required|date|after_or_equal:start_date',
    ];

    private $msg = [
        'employee_code.required' => 'Mã nhân viên là bắt buộc.',
        'employee_code.unique' => 'Mã nhân viên đã tồn tại.',
        'username.unique' => 'Tên đăng nhập đã tồn tại.',
        'password.required' => 'Mật khẩu là bắt buộc.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        'full_name.required' => 'Họ và tên là bắt buộc.',
        'birthday.required' => 'Ngày sinh là bắt buộc.',
        'hometown.required' => 'Quê quán là bắt buộc.',
        'phone_number.required' => 'Số điện thoại là bắt buộc.',
        'department_code.exists' => 'Mã phòng ban không hợp lệ.',
        'employee_position_code.exists' => 'Mã chức vụ không hợp lệ.',
        'contract_code.unique' => 'Mã hợp đồng đã tồn tại.',
        'specialized_code.exists' => 'Mã chuyên môn không hợp lệ.',
        'education_level_code.exists' => 'Mã trình độ học vấn không hợp lệ.',
        'image.required' => 'Ảnh là bắt buộc.',
        'image.image' => 'Ảnh phải là định dạng hình ảnh.',
        'start_date.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc.',
        'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        'basic_salary.required' => 'Lương cơ bản là bắt buộc.',
        'social_insurance.required' => 'Bảo hiểm xã hội là bắt buộc.',
        'health_insurance.required' => 'Bảo hiểm y tế là bắt buộc.',
        'unemployment_insurance.required' => 'Bảo hiểm thất nghiệp là bắt buộc.',
        'allowance.required' => 'Phụ cấp là bắt buộc.',
        'income_tax.required' => 'Thuế thu nhập cá nhân là bắt buộc.',
        'bonus_money.required' => 'Tiền thưởng là bắt buộc.',
        'discipline_money.required' => 'Tiền kỷ luật là bắt buộc.',
        'pay_day.required' => 'Ngày trả lương là bắt buộc.',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Employee::select(
            'employee_code',
            'full_name',
            'hometown',
            'phone_number'
        );
        if (request('employee_code')) {
            // Tìm chính xác theo mã nhân viên
            $query->where('employee_code', request('employee_code'));
        }
        if (request('full_name')) {
            // Tìm theo tên nhân viên
            $query->where('full_name', 'like', '%' . request('full_name') . '%');
        }
        if (request('department_code')) {
            // Tìm theo mã phòng ban
            $query->where('department_code', request('department_code'));
        }
        // xem câu sql
        //dd($query->toSql());
        $employees = $query->orderByDesc('created_at')->paginate();
        return view('admin.employee.index', compact('employees'));
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
        return view('admin.employee.create', compact(
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
        $validated = $request->validate($this->rules, $this->msg, $this->fields);

        $validated['username'] = $this->generateUsername($validated['full_name']);
        $validated['status'] = 1;
        $validated['created_by'] = auth()->guard('admin')->id();
        $validated['created_at'] = now();
        $validated['password'] = bcrypt($request->password);

        $img = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->image->move(public_path('images/employees'), $img);
        $validated['image'] = 'images/employees/' . $img;

         // Lưu nhân viên
         Employee::create($validated);

        $salaryDetail = new SalaryDetail();
        $salaryDetail->employee_code = $validated['employee_code'];
        $salaryDetail->basic_salary = $validated['basic_salary'];
        $salaryDetail->social_insurance = $validated['social_insurance'];
        $salaryDetail->health_insurance = $validated['health_insurance'];
        $salaryDetail->unemployment_insurance = $validated['unemployment_insurance'];
        $salaryDetail->allowance = $validated['allowance'];
        $salaryDetail->income_tax = $validated['income_tax'];
        $salaryDetail->bonus_money = $validated['bonus_money'];
        $salaryDetail->discipline_money = $validated['discipline_money'];
        $salaryDetail->pay_day = $validated['pay_day'];
        $salaryDetail->total_salary = $validated['basic_salary']
            + $validated['bonus_money'] //tien thuong
            + $validated['allowance'] //phu cap
            - $validated['income_tax'] //thue nhap ca nhan
            - $validated['discipline_money'] //tien ky luat
            - $validated['social_insurance'] // bao hiem xa hoi
            - $validated['health_insurance']  // bao hiem y te
            - $validated['unemployment_insurance']; // bao hiem that nghiep
        $salaryDetail->save();

        $contract = new Contract();
        $contract->salary_detail_id = $salaryDetail->id;
        $contract->contract_code = $validated['contract_code'];
        $contract->employee_code = $validated['employee_code'];
        $contract->contract_type = $validated['contract_type'];
        $contract->start_date = $validated['start_date'];
        $contract->end_date = $validated['end_date'];
        $contract->note = $validated['note'];
        $contract->save();

        return redirect()->route('admin.employee.index')
            ->with('success', 'Nhân viên đã được tạo thành công');
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

        return view('admin.employee.edit', compact(
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
            if ($employee->image && file_exists(public_path($employee->image))) {
                unlink(public_path($employee->image));
            }
            $img = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/employees'), $img);
            $validated['image'] = 'images/employees/' . $img;
        } else {
            unset($validated['image']);
        }
        $employee->update($validated);
        return redirect()->route('admin.employee.edit', ['employee' => $employee->employee_code])
            ->with('success', 'Thông tin nhân viên đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        if ($employee->image) {
            if (file_exists(public_path($employee->image)))
                unlink(public_path($employee->image));
        }
        $contracts = Contract::where('employee_code', $id)->first();
        if ($contracts) {
            return redirect()->route('admin.employee.index')
                ->with('error', 'Nhân viên này đang có hợp đồng, không thể xóa');
        }
        $employee->delete();
        return redirect()->route('admin.employee.index')
            ->with('success', 'Nhân viên đã được xóa thành công');
    }
    private function generateUsername(string $fullname): string
{
    $segments = explode(" ", trim($fullname));
    $name = array_pop($segments);
    $initials = '';
    foreach ($segments as $part) {
        if (!empty($part)) {
            $initials .= mb_substr($part, 0, 1);
        }
    }

    $raw = $name . $initials;
    $username = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $raw);
    $username = str_replace(['đ', 'Đ'], ['d', 'D'], $username);
    $username = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $username));

    $original = $username;
    $i = 2;
    while (Employee::where('username', $username)->exists()) {
        $username = $original . $i++;
    }

    return $username;
}

}


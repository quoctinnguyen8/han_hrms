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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
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
        'contract_code' => 'required|unique:contracts,contract_code',
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

    public function index()
    {
        $query = Employee::select(
            'employee_code',
            'full_name',
            'hometown',
            'phone_number',
            'department_code',
            'status',
            'created_at',
            'created_by'
        )
        ->with('department')
        ->orderBy('created_at', 'desc');

        if (request('employee_code')) {
            $query->where('employee_code', request('employee_code'));
        }
        if (request('full_name')) {
            $query->where('full_name', 'like', '%' . request('full_name') . '%');
        }
        if (request('department_code')) {
            $query->where('department_code', request('department_code'));
        }

        $employees = $query->paginate();
        return view('admin.employee.index', compact('employees'));
    }

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

    private function generateUsername($full_name)
    {
        // Xóa dấu tiếng Việt
        $full_name = $this->removeVietnameseAccents($full_name);

        // Tách các phần của tên
        $nameParts = explode(' ', trim($full_name));
        $lastName = array_shift($nameParts);
        $middleNames = $nameParts;
        $firstName = array_pop($nameParts);

        // Tạo username theo quy tắc
        $username = strtolower($firstName);

        // Thêm chữ cái đầu của họ
        if (!empty($lastName)) {
            $username .= substr(strtolower($lastName), 0, 1);
        }

        // Thêm chữ cái đầu của tên đệm
        foreach ($middleNames as $middleName) {
            if (!empty($middleName)) {
                $username .= substr(strtolower($middleName), 0, 1);
            }
        }

        // Kiểm tra và xử lý trùng username
        $originalUsername = $username;
        $counter = 1;

        while (Employee::where('username', $username)->exists()) {
            $counter++;
            $username = $originalUsername . $counter;
        }

        return $username;
    }

    private function removeVietnameseAccents($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        return $str;
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules, $this->msg, $this->fields);

        // Tạo username tự động nếu không được cung cấp
        if (empty($validated['username'])) {
            $validated['username'] = $this->generateUsername($validated['full_name']);
        }

        $validated['status'] = $validated['status'] ? 1 : 0;

        // Lưu hợp đồng
        $contract = new Contract();
        $contract->contract_code = $validated['contract_code'];
        $contract->contract_type = $validated['contract_type'];
        $contract->start_date = $validated['start_date'];
        $contract->end_date = $validated['end_date'];
        $contract->note = $validated['note'];
        $contract->save();

        $validated['password'] = bcrypt($request->password);

        // Lưu ảnh
        $imagePath = $request->file('image')->store('employees', 'public');
        $validated['image'] = $imagePath;

        // Thêm thông tin người tạo
        $validated['created_at'] = now();
        $validated['created_by'] = Auth::user()->username;

        $validated['contract_code'] = $validated['contract_code'];
        Employee::create($validated);

        // Tính toán và lưu thông tin lương
        $totalSalary = $validated['basic_salary']
            + $validated['allowance']
            - $validated['income_tax']
            - $validated['discipline_money']
            - $validated['social_insurance']
            - $validated['health_insurance']
            - $validated['unemployment_insurance'];

        SalaryDetail::create([
            'employee_code' => $validated['employee_code'],
            'basic_salary' => $validated['basic_salary'],
            'social_insurance' => $validated['social_insurance'],
            'health_insurance' => $validated['health_insurance'],
            'unemployment_insurance' => $validated['unemployment_insurance'],
            'allowance' => $validated['allowance'],
            'income_tax' => $validated['income_tax'],
            'bonus_money' => $validated['bonus_money'],
            'discipline_money' => $validated['discipline_money'],
            'pay_day' => $validated['pay_day'],
            'total_salary' => $totalSalary,
        ]);

        return redirect()->route('admin.employee.index')
            ->with('success', 'Nhân viên đã được tạo thành công');
    }

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

    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $rules = [
            'username' => 'required|unique:employees,username,' . $employee->employee_code . ',employee_code',
            'full_name' => 'required|string|max:40',
            'birthday' => 'required|date',
            'hometown' => 'required|string|max:90',
            'phone_number' => 'required|string|max:11',
            'identity_card' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:8|confirmed',
            'gender' => 'required|boolean',
            'ethnic' => 'required|string|max:10',
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

        $validated['status'] = $validated['status'] ? 1 : 0;

        if (!$request->filled('password')) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('employees', 'public');
            $validated['image'] = $imagePath;
        } else {
            unset($validated['image']);
        }

        $employee->update($validated);
        return redirect()->route('admin.employee.edit', ['employee' => $employee->employee_code])
            ->with('success', 'Thông tin nhân viên đã được cập nhật thành công');
    }

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);

        // Xóa ảnh đại diện
        if ($employee->image) {
            Storage::disk('public')->delete($employee->image);
        }

        // Xóa hợp đồng liên quan
        if ($employee->contract_code) {
            Contract::where('contract_code', $employee->contract_code)->delete();
        }

        // Xóa thông tin lương
        SalaryDetail::where('employee_code', $employee->employee_code)->delete();

        // Xóa nhân viên
        $employee->delete();

        return redirect()->route('admin.employee.index')
            ->with('success', 'Nhân viên đã được xóa thành công');
    }
}

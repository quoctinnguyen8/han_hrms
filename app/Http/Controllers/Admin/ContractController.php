<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\SalaryDetail;
use Illuminate\Http\Request;

class ContractController extends Controller
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
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeCode = request('employeeCode');
        $employee = Employee::find($employeeCode);
        if ($employeeCode) {
            if (!$employee) {
                return redirect()->route('admin.contracts.index')
                    ->with('error', 'Mã nhân viên không tồn tại');
            }
            $contracts = $employee->contract()
                ->select([
                    'contracts.contract_code',
                    'contracts.contract_type',
                    'contracts.start_date',
                    'contracts.end_date',
                ])
                ->orderBy('contracts.start_date', 'desc')
                ->paginate();
            return view('admin.contract.index', compact('contracts', 'employeeCode', 'employee'));
        } else {
            $contracts = Contract::select([
                'contracts.contract_code',
                'contracts.contract_type',
                'contracts.start_date',
                'contracts.end_date',
            ])
            ->orderBy('contracts.start_date', 'desc')
            ->paginate();
            return view('admin.contract.index2', compact('contracts'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contract_code' => 'required|string|unique:contracts',
            'employee_code' => 'required|string',
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
            'bonus_money' => 'required|numeric|min:1|max:99999999999',
            'discipline_money' => 'required|numeric|min:1|max:99999999999',
            'pay_day' => 'required|date|after_or_equal:start_date',

        ], [
            'start_date.before_or_equal' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc',
            'end_date.after_or_equal' => 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu',
            'start_date.after_or_equal' => 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại',
            'end_date.after_or_equal' => 'Ngày kết thúc không được nhỏ hơn ngày hiện tại',
            'pay_day.after_or_equal' => 'Ngày trả lương không được nhỏ hơn ngày bắt đầu',
        ], $this->fields);

        $contract = new Contract();
        $contract->contract_code = $validatedData['contract_code'];
        $contract->contract_type = $validatedData['contract_type'];
        $contract->start_date = $validatedData['start_date'];
        $contract->end_date = $validatedData['end_date'];
        $contract->note = $validatedData['note'];
        $contract->save();

        $employee = Employee::where('employee_code', $validatedData['employee_code'])->first();
        if (!$employee) {
            return back()->with('error', 'Mã nhân viên không tồn tại');
        }
        $employee->contract_code = $validatedData['contract_code'];
        $employee->save();
        $salaryDetail = SalaryDetail::where('employee_code', $validatedData['employee_code'])->first();
        if (!$salaryDetail) {
            $salaryDetail = new SalaryDetail();
            $salaryDetail->employee_code = $validatedData['employee_code'];
        }
        $salaryDetail->basic_salary = $validatedData['basic_salary'];
        $salaryDetail->social_insurance = $validatedData['social_insurance'];
        $salaryDetail->health_insurance = $validatedData['health_insurance'];
        $salaryDetail->unemployment_insurance = $validatedData['unemployment_insurance'];
        $salaryDetail->allowance = $validatedData['allowance'];
        $salaryDetail->income_tax = $validatedData['income_tax'];
        $salaryDetail->bonus_money = $validatedData['bonus_money'];
        $salaryDetail->discipline_money = $validatedData['discipline_money'];
        $salaryDetail->pay_day = $validatedData['pay_day'];
        $salaryDetail->total_salary = $validatedData['basic_salary']
            + $validatedData['allowance'] //phu cap
            - $validatedData['income_tax'] //thue nhap ca nhan 
            - $validatedData['discipline_money'] //tien ky luat
            - $validatedData['social_insurance'] // bao hiem xa hoi
            - $validatedData['health_insurance']  // bao hiem y te
            - $validatedData['unemployment_insurance']; // bao hiem that nghiep
        $salaryDetail->save();

        return redirect()->route('admin.contracts.index', ['employeeCode' => $validatedData['employee_code']])
            ->with('success', 'Thêm thông tin hợp đồng thành công');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contract = Contract::findOrFail($id);
        $employeeCode = $contract->employees()->first()->employee_code ?? null;
        $salaryDetail = SalaryDetail::where('employee_code', $employeeCode)->firstOrFail();
        return view('admin.contract.edit', compact('contract', 'salaryDetail'))
            ->with('employeeCode', $employeeCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contract = Contract::findOrFail($id);
        $employee = Employee::where('contract_code', $id)->firstOrFail();
        $employeeCode = $employee->employee_code;
        $validatedData = $request->validate([
            'note' => 'nullable|string|max:500',
            'basic_salary' => 'required|numeric|min:1|max:99999999999',
            'social_insurance' => 'required|numeric|min:1|max:99999999999',
            'health_insurance' => 'required|numeric|min:1|max:99999999999',
            'unemployment_insurance' => 'required|numeric|min:1|max:99999999999',
            'allowance' => 'required|numeric|min:1|max:99999999999',
            'income_tax' => 'required|numeric|min:1|max:99999999999',
            'bonus_money' => 'required|numeric|min:1|max:99999999999',
            'discipline_money' => 'required|numeric|min:1|max:99999999999',
            'pay_day' => 'required|date|after_or_equal:' . $contract->start_date,
        ], [
            'pay_day.after_or_equal' => 'Ngày trả lương không được nhỏ hơn ngày bắt đầu',
        ], $this->fields);
        $contract->note = $validatedData['note'];
        $contract->save();
        $salaryDetail = SalaryDetail::where('employee_code', $employeeCode)->firstOrFail();
        $salaryDetail->basic_salary = $validatedData['basic_salary'];
        $salaryDetail->social_insurance = $validatedData['social_insurance'];
        $salaryDetail->health_insurance = $validatedData['health_insurance'];
        $salaryDetail->unemployment_insurance = $validatedData['unemployment_insurance'];
        $salaryDetail->allowance = $validatedData['allowance'];
        $salaryDetail->income_tax = $validatedData['income_tax'];
        $salaryDetail->bonus_money = $validatedData['bonus_money'];
        $salaryDetail->discipline_money = $validatedData['discipline_money'];
        $salaryDetail->pay_day = $validatedData['pay_day'];
        $salaryDetail->total_salary = $validatedData['basic_salary']
            + $validatedData['allowance'] //phu cap
            - $validatedData['income_tax'] //thue nhap ca nhan 
            - $validatedData['discipline_money'] //tien ky luat
            - $validatedData['social_insurance'] // bao hiem xa hoi
            - $validatedData['health_insurance']  // bao hiem y te
            - $validatedData['unemployment_insurance']; // bao hiem that nghiep
        $salaryDetail->save();
        return back()->with('success', 'Cập nhật thông tin hợp đồng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contract = Contract::findOrFail($id);
        $employee = Employee::where('contract_code', $id)->first();
        if (!$employee) {
            $contract->delete();
            return redirect()->route('admin.contracts.index')
            ->with('success', 'Xóa thông tin hợp đồng thành công');
        }
        $employeeCode = $employee->employee_code;
        if ($contract->employees()->exists()) {
            return redirect()->route('admin.contracts.index', ['employeeCode' => $employeeCode])
                ->with('error', 'Không thể xóa hợp đồng này vì nó đang được sử dụng');
        }
        $contract->delete();
        return redirect()->route('admin.contracts.index', ['employeeCode' => $employeeCode])
            ->with('success', 'Xóa thông tin hợp đồng thành công');
    }
}

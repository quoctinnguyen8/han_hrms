<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use Illuminate\Http\Request;

class BonusController extends BaseController
{
    private $fields = [
        'employee_code' => 'Mã nhân viên',
        'bonus_date' => 'Ngày khen thưởng',
        'reason' => 'Lý do khen thưởng',
        'bonus_money' => 'Số tiền khen thưởng'
    ];

    public function index()
    {
        $employeeCode = request('employeeCode');
        if ($employeeCode) {
            $bonuses = Bonus::select([
                'id',
                'bonus_date',
                'reason',
                'bonus_money'
            ])->where('employee_code', $employeeCode)->paginate();
            return view('admin.bonus.index', compact('bonuses', 'employeeCode'));
        }else{
            $bonuses = Bonus::join('employees', 'employees.employee_code', '=', 'bonuses.employee_code')
                ->select([
                    'bonuses.id',
                    'bonuses.employee_code',
                    'employees.full_name',
                    'bonuses.bonus_date',
                    'bonuses.reason',
                    'bonuses.bonus_money'
                ])
                ->orderBy('bonuses.bonus_date', 'desc')
                ->paginate();
            return view('admin.bonus.index2', compact('bonuses'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_code' => 'required|string',
            'bonus_date' => 'required|date|before_or_equal:today',
            'reason' => 'required|string|max:500',
            'bonus_money' => 'required|numeric|min:1|max:99999999999'
        ],
        [
            'bonus_date.before_or_equal' => 'Ngày khen thưởng không được lớn hơn ngày hiện tại',
        ], $this->fields);
        Bonus::create($validatedData);
        return redirect()->route('admin.bonuses.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Thêm thông tin khen thưởng thành công');
    }

    public function edit(string $id)
    {
        $bonus = Bonus::findOrFail($id);
        return view('admin.bonus.edit', compact('bonus'));
    }

    public function update(Request $request, string $id)
    {
        $bonus = Bonus::findOrFail($id);
        $validatedData = $request->validate([
            'bonus_date' => 'required|date|before_or_equal:today',
            'reason' => 'required|string|max:500',
            'bonus_money' => 'required|numeric|min:1|max:99999999999'
        ],
        [
            'bonus_date.before_or_equal' => 'Ngày khen thưởng không được lớn hơn ngày hiện tại',
        ],$this->fields);
        $bonus->update($validatedData);

        return back()
            ->with('success', 'Cập nhật thông tin khen thưởng thành công');
    }

    public function destroy(string $id)
    {
        $bonus = Bonus::findOrFail($id);
        $employeeCode = $bonus->employee_code;
        $bonus->delete();
        return back()
            ->with('success', 'Xóa thông tin khen thưởng thành công');
    }
}

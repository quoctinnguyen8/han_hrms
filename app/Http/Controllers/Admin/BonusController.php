<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use Illuminate\Http\Request;

class BonusController extends Controller
{
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
        }
    }

    public function store(Request $request)
    {
        $fields = [
            'employee_code' => 'Mã nhân viên',
            'bonus_date' => 'Ngày khen thưởng',
            'reason' => 'Lý do khen thưởng',
            'bonus_money' => 'Số tiền khen thưởng'
        ];
        $validatedData = $request->validate([
            'employee_code' => 'required|string',
            'bonus_date' => 'required|date',
            'reason' => 'required|string',
            'bonus_money' => 'required|numeric'
        ], [], $fields);
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
            'employee_code' => 'required|string',
            'bonus_date' => 'required|date',
            'reason' => 'required|string',
            'bonus_money' => 'required|numeric'
        ]);
        $bonus->update($validatedData);
        return redirect()->route('admin.bonuses.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Cập nhật thông tin khen thưởng thành công');
    }

    public function destroy(string $id)
    {
        $bonus = Bonus::findOrFail($id);
        $employeeCode = $bonus->employee_code;
        $bonus->delete();
        return redirect()->route('admin.bonuses.index', ['employeeCode'=>$employeeCode])
            ->with('success', 'Xóa thông tin khen thưởng thành công');
    }
}

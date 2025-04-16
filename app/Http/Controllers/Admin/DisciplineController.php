<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{

    public function index()
    {
        $employeeCode = request('employeeCode');
        if ($employeeCode) {
            $disciplines = Discipline::select([
                'id',
                'discipline_date',
                'reason',
                'discipline_money'
            ])->where('employee_code', $employeeCode)->paginate();
            return view('admin.discipline.index', compact('disciplines', 'employeeCode'));
        }
    }
    public function store(Request $request)
    {
        $fields = [
            'employee_code' => 'Mã nhân viên',
            'discipline_date' => 'Ngày kỷ luật',
            'reason' => 'Lý do kỷ luật',
            'discipline_money' => 'Số tiền kỷ luật'
        ];
        $validatedData = $request->validate([
            'employee_code' => 'required|string',
            'discipline_date' => 'required|date',
            'reason' => 'nullable|string',
            'discipline_money' => 'nullable|numeric'
        ], [], $fields);
        Discipline::create($validatedData);
        return redirect()->route('admin.disciplines.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Thêm thông tin kỷ luật thành công');
    }
    public function edit(string $id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('admin.discipline.edit', compact('discipline'));
    }

    public function update(Request $request, string $id)
    {
        $discipline = Discipline::findOrFail($id);
        $validatedData = $request->validate([
            'employee_code' => 'required|string',
            'discipline_date' => 'required|date',
            'reason' => 'nullable|string',
            'discipline_money' => 'nullable|numeric'
        ]);
        $discipline->update($validatedData);
        return redirect()->route('admin.disciplines.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Cập nhật thông tin kỷ luật thành công');
    }

    public function destroy(string $id)
    {
        $discipline = Discipline::findOrFail($id);
        $employeeCode = $discipline->employee_code;
        $discipline->delete();
        return redirect()->route('admin.disciplines.index', ['employeeCode'=>$employeeCode])
            ->with('success', 'Xóa thông tin kỷ luật thành công');
    }
}

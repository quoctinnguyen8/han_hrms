<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends BaseController
{
    private $fields = [
        'employee_code' => 'Mã nhân viên',
        'discipline_date' => 'Ngày kỷ luật',
        'reason' => 'Lý do kỷ luật',
        'discipline_money' => 'Số tiền kỷ luật'
    ];

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
        }else{
            $disciplines = Discipline::join('employees', 'employees.employee_code', '=', 'disciplines.employee_code')
                ->select([
                    'disciplines.id',
                    'disciplines.employee_code',
                    'employees.full_name',
                    'disciplines.discipline_date',
                    'disciplines.reason',
                    'disciplines.discipline_money'
                ])
                ->orderBy('disciplines.discipline_date', 'desc')
                ->paginate();
            return view('admin.discipline.index2', compact('disciplines'));
        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_code' => 'required|string',
            'discipline_date' => 'required|date|before_or_equal:today',
            'reason' => 'nullable|string|max:500',
            'discipline_money' => 'nullable|numeric|min:1|max:99999999999'
        ],
        [
            'discipline_date.before_or_equal' => 'Ngày kỷ luật không được lớn hơn ngày hiện tại',
        ], $this->fields);
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
            'discipline_date' => 'required|date|before_or_equal:today',
            'reason' => 'nullable|string|max:500',
            'discipline_money' => 'nullable|numeric|min:1|max:99999999999'
        ],
        [
            'discipline_date.before_or_equal' => 'Ngày kỷ luật không được lớn hơn ngày hiện tại',
        ], $this->fields);
        $discipline->update($validatedData);

        // chuyển hướng về trang trước đó
        return back()
            ->with('success', 'Cập nhật thông tin kỷ luật thành công');
    }

    public function destroy(string $id)
    {
        $discipline = Discipline::findOrFail($id);
        $employeeCode = $discipline->employee_code;
        $discipline->delete();
        return back()
            ->with('success', 'Xóa thông tin kỷ luật thành công');
    }
}

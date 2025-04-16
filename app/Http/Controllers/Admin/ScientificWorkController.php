<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScientificWork;

class ScientificWorkController extends Controller
{
    private $fields = [
        'employee_code' => 'Mã nhân viên',
        'scientific_works_name' => 'Tên công trình khoa học',
        'year' => 'Năm',
        'magazine_name' => 'Tên tạp chí'
    ];

    public function index()
    {
        $employeeCode = request('employeeCode');
        if ($employeeCode) {
            $scientificWorks = ScientificWork::select([
                'id',
                'scientific_works_name',
                'year',
                'magazine_name'
            ])->where('employee_code', $employeeCode)->paginate();
            return view('admin.scientific_work.index', compact('scientificWorks', 'employeeCode'));
        }else{
            $scientificWorks = ScientificWork::join('employees', 'employees.employee_code', '=', 'scientific_works.employee_code')
                ->select([
                    'scientific_works.id',
                    'scientific_works.employee_code',
                    'employees.full_name',
                    'scientific_works.scientific_works_name',
                    'scientific_works.year',
                    'scientific_works.magazine_name'
                ])
                ->orderBy('scientific_works.year', 'desc')
                ->paginate();
            return view('admin.scientific_work.index2', compact('scientificWorks'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_code' => 'required|string|max:30',
            'scientific_works_name' => 'required|string|max:200',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'magazine_name' => 'nullable|string|max:200'
        ], [], $this->fields);
        ScientificWork::create($validatedData);
        return redirect()->route('admin.scientific_works.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Thêm thông tin công trình khoa học thành công');
    }

    public function edit(string $id)
    {
        $scientificWork = ScientificWork::findOrFail($id);
        return view('admin.scientific_work.edit', compact('scientificWork'));
    }

    public function update(Request $request, string $id)
    {
        $scientificWork = ScientificWork::findOrFail($id);

        $validatedData = $request->validate([
            'scientific_works_name' => 'required|string|max:200',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'magazine_name' => 'nullable|string|max:200'
        ], [], $this->fields);

        $scientificWork->update($validatedData);
        return back()
                ->with('success', 'Cập nhật công trình khoa học thành công');
    }

    public function destroy(string $id)
    {
        $scientificWork = ScientificWork::findOrFail($id);
        $scientificWork->delete();
        return back()
                ->with('success', 'Xóa công trình khoa học thành công');
    }
}

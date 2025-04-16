<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AfterUniversity;
use Illuminate\Http\Request;

class AfterUniversityController extends Controller
{
    private $fields = [
        'employee_code' => 'Mã nhân viên',
        'specialized_master' => 'Chuyên ngành thạc sĩ',
        'training_place_master' => 'Nơi đào tạo thạc sĩ',
        'degree_year_master' => 'Năm cấp bằng thạc sĩ',
        'specialized_doctorate' => 'Chuyên ngành tiến sĩ',
        'training_place_doctorate' => 'Nơi đào tạo tiến sĩ',
        'degree_year_doctorate' => 'Năm cấp bằng tiến sĩ'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeCode = request('employeeCode');
        if ($employeeCode) {
            $afterUniversities = AfterUniversity::select([
                'id',
                'specialized_master',
                'training_place_master',
                'degree_year_master',
                'specialized_doctorate',
                'training_place_doctorate',
                'degree_year_doctorate',
            ])->where('employee_code', $employeeCode)->paginate();
            return view('admin.after_university.index', compact('afterUniversities', 'employeeCode'));
        } else{
            $afterUniversities = AfterUniversity::join('employees', 'employees.employee_code', '=', 'after_universities.employee_code')
                ->select([
                    'after_universities.id',
                    'after_universities.employee_code',
                    'employees.full_name',
                    'after_universities.specialized_master',
                    'after_universities.training_place_master',
                    'after_universities.degree_year_master',
                    'after_universities.specialized_doctorate',
                    'after_universities.training_place_doctorate',
                    'after_universities.degree_year_doctorate'
                ])
                ->orderBy('after_universities.degree_year_master', 'desc')
                ->paginate();
            return view('admin.after_university.index2', compact('afterUniversities'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_code' => 'required|string|max:30',
            'specialized_master' => 'nullable|string|max:50',
            'training_place_master' => 'nullable|string|max:50',
            'degree_year_master' => 'nullable|integer|min:1950|max:2100',
            'specialized_doctorate' => 'nullable|string|max:50',
            'training_place_doctorate' => 'nullable|string|max:50',
            'degree_year_doctorate' => 'nullable|integer|min:1950|max:2100'
        ], [], $this->fields);
        AfterUniversity::create($validatedData);
        return redirect()->route('admin.after_universities.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Thêm thông tin sau đại học thành công');
    }

    public function edit(string $id)
    {
        $afterUniversity = AfterUniversity::findOrFail($id);
        return view('admin.after_university.edit', compact('afterUniversity'));
    }


    public function update(Request $request, string $id)
    {
        $afterUniversity = AfterUniversity::findOrFail($id);

        $validatedData = $request->validate([
            'specialized_master' => 'nullable|string|max:50',
            'training_place_master' => 'nullable|string|max:50',
            'degree_year_master' => 'nullable|integer|min:1950|max:2100',
            'specialized_doctorate' => 'nullable|string|max:50',
            'training_place_doctorate' => 'nullable|string|max:50',
            'degree_year_doctorate' => 'nullable|integer|min:1950|max:2100'
        ], [], $this->fields);

        $afterUniversity->update($validatedData);
        return back()
            ->with('success', 'Cập nhật thông tin sau đại học thành công');
    }


    public function destroy(string $id)
    {
        $afterUniversity = AfterUniversity::findOrFail($id);
        $employeeCode = $afterUniversity->employee_code;
        $afterUniversity->delete();
        return back()
            ->with('success', 'Xóa thông tin sau đại học thành công');
    }
}

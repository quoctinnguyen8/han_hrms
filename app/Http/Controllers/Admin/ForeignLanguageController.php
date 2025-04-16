<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForeignLanguage;

class ForeignLanguageController extends BaseController
{
    private $fields = [
        'employee_code' => 'Mã nhân viên',
        'foreign_language_name' => 'Tên ngoại ngữ',
        'level' => 'Trình độ',
    ];

    public function index()
    {
        $employeeCode = request('employeeCode');
        if ($employeeCode) {
            $foreignLanguages = ForeignLanguage::select([
                'id',
                'foreign_language_name',
                'level',
            ])->where('employee_code', $employeeCode)->paginate();
            return view('admin.foreign_language.index', compact('foreignLanguages', 'employeeCode'));
        } else {
            $foreignLanguages = ForeignLanguage::join('employees', 'employees.employee_code', '=', 'foreign_languages.employee_code')
                ->select([
                    'foreign_languages.id',
                    'foreign_languages.employee_code',
                    'employees.full_name',
                    'foreign_languages.foreign_language_name',
                    'foreign_languages.level',
                ])
                ->orderBy('foreign_languages.foreign_language_name', 'asc')
                ->orderBy('foreign_languages.level', 'desc')
                ->paginate();
            return view('admin.foreign_language.index2', compact('foreignLanguages'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_code' => 'required|string|max:30',
            'foreign_language_name' => 'required|string|max:50',
            'level' => 'nullable|string|max:30',
        ], [], $this->fields);
        ForeignLanguage::create($validatedData);
        return redirect()->route('admin.foreign_languages.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Thêm thông tin ngoại ngữ thành công');
    }

    public function edit(string $id)
    {
        $foreignLanguage = ForeignLanguage::findOrFail($id);
        return view('admin.foreign_language.edit', compact('foreignLanguage'));
    }

    public function update(Request $request, string $id)
    {
        $foreignLanguage = ForeignLanguage::findOrFail($id);

        $validatedData = $request->validate([
            'foreign_language_name' => 'required|string|max:50',
            'level' => 'nullable|string|max:30',
        ], [], $this->fields);

        $foreignLanguage->update($validatedData);
        return back()
                ->with('success', 'Cập nhật ngoại ngữ thành công');
    }

    public function destroy(string $id)
    {
        $foreignLanguage = ForeignLanguage::findOrFail($id);
        $foreignLanguage->delete();
        return back()
                ->with('success', 'Xóa ngoại ngữ thành công');
    }
}

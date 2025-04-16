<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScientificResearchTopic;

class ScientificResearchTopicController extends Controller
{
    private $fields = [
        'employee_code' => 'Mã nhân viên',
        'scientific_research_topic_name' => 'Tên đề tài nghiên cứu',
        'year_of_begin' => 'Năm bắt đầu',
        'year_of_complete' => 'Năm hoàn thành',
        'level_topic' => 'Cấp đề tài',
        'responsibility_in_the_topic' => 'Trách nhiệm trong đề tài'
    ];

    public function index()
    {
        $employeeCode = request('employeeCode');
        if ($employeeCode) {
            $scientificResearchTopics = ScientificResearchTopic::select([
                'id',
                'scientific_research_topic_name',
                'year_of_begin',
                'year_of_complete',
                'level_topic',
                'responsibility_in_the_topic'
            ])->where('employee_code', $employeeCode)->paginate();
            return view('admin.scientific_research_topic.index', compact('scientificResearchTopics', 'employeeCode'));
        } else{
            $scientificResearchTopics = ScientificResearchTopic::join('employees', 'employees.employee_code', '=', 'scientific_research_topics.employee_code')
                ->select([
                    'scientific_research_topics.id',
                    'scientific_research_topics.employee_code',
                    'employees.full_name',
                    'scientific_research_topics.scientific_research_topic_name',
                    'scientific_research_topics.year_of_begin',
                    'scientific_research_topics.year_of_complete',
                    'scientific_research_topics.level_topic',
                    'scientific_research_topics.responsibility_in_the_topic'
                ])
                ->orderBy('scientific_research_topics.year_of_begin', 'desc')
                ->paginate();
            return view('admin.scientific_research_topic.index2', compact('scientificResearchTopics'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_code' => 'required|string|max:30',
            'scientific_research_topic_name' => 'required|string|max:200',
            'year_of_begin' => 'nullable|integer|min:1900|max:' . date('Y'),
            'year_of_complete' => 'nullable|integer|min:1900|max:2100|before_or_equal:year_of_begin',
            'level_topic' => 'nullable|string|max:50',
            'responsibility_in_the_topic' => 'nullable|string|max:100'
        ], [
            'year_of_begin.max' => 'Năm bắt đầu không được lớn hơn năm hiện tại',
            'year_of_complete.before_or_equal' => 'Năm hoàn thành không được lớn hơn năm bắt đầu',
        ], $this->fields);
        ScientificResearchTopic::create($validatedData);
        return redirect()->route('admin.scientific_research_topics.index', ['employeeCode'=>$validatedData['employee_code']])
            ->with('success', 'Thêm thông tin đề tài nghiên cứu thành công');
    }

    public function edit(string $id)
    {
        $scientificResearchTopic = ScientificResearchTopic::findOrFail($id);
        return view('admin.scientific_research_topic.edit', compact('scientificResearchTopic'));
    }

    public function update(Request $request, string $id)
    {
        $scientificResearchTopic = ScientificResearchTopic::findOrFail($id);

        $validatedData = $request->validate([
            'scientific_research_topic_name' => 'required|string|max:200',
            'year_of_begin' => 'nullable|integer|min:1900|max:' . date('Y'),
            'year_of_complete' => 'nullable|integer|min:1900|max:2100|before_or_equal:year_of_begin',
            'level_topic' => 'nullable|string|max:50',
            'responsibility_in_the_topic' => 'nullable|string|max:100'
        ],
        [
            'year_of_begin.max' => 'Năm bắt đầu không được lớn hơn năm hiện tại',
            'year_of_complete.before_or_equal' => 'Năm hoàn thành không được lớn hơn năm bắt đầu',
        ], $this->fields);

        $scientificResearchTopic->update($validatedData);
        return back()
                ->with('success', 'Cập nhật đề tài nghiên cứu thành công');
    }

    public function destroy(string $id)
    {
        $scientificResearchTopic = ScientificResearchTopic::findOrFail($id);
        $scientificResearchTopic->delete();
        return back()
                ->with('success', 'Xóa đề tài nghiên cứu thành công');
    }
}

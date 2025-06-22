<?php

/* Định nghĩa menu cho admin
   Mỗi menu bao gồm các thuộc tính sau:

    key: mã menu - duy nhất không trùng
    name: tên menu - hiển thị trên giao diện
    icon: icon hiển thị trên giao diện - sử dụng remix icons https://remixicon.com/
    route: route tương ứng với menu, dùng dấu # nếu không có route
    children: danh sách menu con (nếu có). Menu con cũng có các thuộc tính tương tự như menu cha
        nhưng không có icon

 */
return [
    [
        'title' => 'Menu chính',
    ],
    [
        'key' => 'admin.dashboard',
        'name' => 'Dashboard',
        'icon' => 'ri-dashboard-line',
        'route' => 'admin.dashboard',
    ],
    [
        'key' => 'admin.employee',
        'name' => 'Nhân viên',
        'icon' => 'ri-user-3-line',
        'route' => '#',
        'children' => [
            [
                'key' => 'admin.departments',
                'name' => 'Phòng ban',
                'route' => 'admin.departments.index',
            ],
            [
                'key' => 'admin.employee.list',
                'name' => 'Danh sách nhân viên',
                'route' => 'admin.employee.index',
            ]
        ],
    ],
    [
        'title' => 'Thông tin nhân viên',
    ],
    [
        'key' => 'admin.report',
        'name' => 'Báo cáo',
        'icon' => 'ri-file-chart-line',
        'route' => '#',
        'children' => [
            [
                'key' => 'admin.report.employees_by_department',
                'name' => 'Nhân viên theo phòng ban',
                'route' => 'admin.employees-by-department',
            ],
            [
                'key' => 'admin.report.employees_by_education_level',
                'name' => 'Nhân viên theo trình độ',
                'route' => 'admin.employees-by-education-level',
            ],
            [
                'key' => 'admin.report.employees_by_specialization',
                'name' => 'Nhân viên theo chuyên môn',
                'route' => 'admin.employees-by-specialization',
            ],
            [
                'key' => 'admin.report.employee_seniority',
                'name' => 'Thâm niên nhân viên',
                'route' => 'admin.employee-seniority',
            ],
            [
                'key' => 'admin.report.bonus_discipline_by_year',
                'name' => 'Khen thưởng/Kỷ luật theo năm',
                'route' => 'admin.bonus-discipline-by-year',
            ],
            [
                'key' => 'admin.report.research_by_year',
                'name' => 'Nghiên cứu khoa học theo năm',
                'route' => 'admin.research-by-year',
            ],
            [
                'key' => 'admin.report.employee_contract',
                'name' => 'Nhân viên theo hợp đồng',
                'route' => 'admin.employee-contract',
            ],
        ]
    ],
    [
        'key' => 'admin.foreign_language.list',
        'name' => 'Ngoại ngữ',
        'icon' => 'ri-translate',
        'route' => 'admin.foreign_languages.index',
    ],
    [
        'key' => 'admin.scientific-research-topic.list',
        'name' => 'Nghiên cứu khoa học',
        'icon' => 'ri-book-2-line',
        'route' => 'admin.scientific_research_topics.index',
    ],
    [
        'key' => 'admin.scientific_work.list',
        'name' => 'Công trình khoa học',
        'icon' => 'ri-bookmark-line',
        'route' => 'admin.scientific_works.index',
    ],
    [
        'key' => 'admin.after_university.list',
        'name' => 'Đào tạo sau đại học',
        'icon' => 'ri-graduation-cap-line',
        'route' => 'admin.after_universities.index',
    ],
    [
        'key' => 'admin.bonus.list',
        'name' => 'Khen thưởng',
        'icon' => 'ri-gift-2-line',
        'route' => 'admin.bonuses.index',
    ],
    [
        'key' => 'admin.discipline.list',
        'name' => 'Kỷ luật',
        'icon' => 'ri-error-warning-line',
        'route' => 'admin.disciplines.index',
    ],
    [
        'key' => 'admin.contract.list',
        'name' => 'Hợp đồng',
        'icon' => 'ri-file-list-3-line',
        'route' => 'admin.contracts.index',
    ],
    [
        'key' => 'admin.management.list',
        'name' => 'Quản lý tài khoản',
        'icon' => 'ri-user-settings-line',
        'route' => 'admin.management.index',
        'is_account_mnt' => true,
    ],

];

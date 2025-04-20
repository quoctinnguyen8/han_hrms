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
        'key' => 'admin.employee',
        'name' => 'Nhân viên',
        'icon' => 'ri-user-3-line',
        'route' => '#',
    ]
];
<?php

use App\Models\Employee;

if (!function_exists('genUsername')) {
    function genUsername(string $fullname): string
    {
        // Tách họ tên
        $segments = explode(" ", trim($fullname));
        $name = array_pop($segments); // lấy tên chính

        // Ghép chữ cái đầu các phần còn lại
        $initials = '';
        foreach ($segments as $part) {
            if (!empty($part)) {
                $initials .= mb_substr($part, 0, 1);
            }
        }

        $combined = $name . $initials;

        // Normalize & xóa dấu
        $normalized = normalizer_normalize($combined, Normalizer::FORM_D);
        $withoutDiacritics = preg_replace('/\p{Mn}/u', '', $normalized);
        $withoutDiacritics = str_replace(['đ', 'Đ'], ['d', 'D'], $withoutDiacritics);

        // Viết thường và xóa ký tự đặc biệt
        $username = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $withoutDiacritics));

        // Xử lý trùng tên trong DB
        $original = $username;
        $i = 2;
        while (Employee::where('username', $username)->exists()) {
            $username = $original . $i++;
        }

        return $username;
    }
}

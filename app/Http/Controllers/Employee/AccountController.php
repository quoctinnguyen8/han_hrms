<?php


namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login()
    {
        return view('employee.account.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('username');
        $password = $request->input('password');

        // Thử đăng nhập bằng username hoặc employee_code
        $credentialsUsername = ['username' => $loginInput, 'password' => $password];
        $credentialsEmployeeCode = ['employee_code' => $loginInput, 'password' => $password];

        $loggedIn = false;

        // Thử đăng nhập bằng username
        if (Auth::guard('employee')->attempt($credentialsUsername)) {
            $loggedIn = true;
        }
        // Nếu không thành công, thử đăng nhập bằng employee_code
        elseif (Auth::guard('employee')->attempt($credentialsEmployeeCode)) {
            $loggedIn = true;
        }

        if ($loggedIn) {
            $user = Auth::guard('employee')->user();

            if ($user->status == 0) {
                Auth::guard('employee')->logout();
                return redirect()->back()->withErrors(['Tài khoản đã bị vô hiệu hóa hoặc nghỉ việc.']);
            }

            return redirect()->route('employee.profile.detail');
        }

        // Nếu cả hai cách đều thất bại
        return redirect()->back()->withErrors(['Thông tin đăng nhập không chính xác.']);
    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AccountController extends BaseController
{
    
    // view đăng nhập
    public function login(Request $request)
    {
        return view('admin.account.login');
    }

    // xử lý đăng nhập
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // kiểm tra xem có tồn tại tài khoản không
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            // chuyển hướng đến trang trước đó, nếu không thì đến trang dashboard
            if ($request->session()->has('url.intended')) {
                return redirect()->intended($request->session()->get('url.intended'));
            }
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công.');
        }
        
        return back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
    }

    // xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }

    public function createAccount()
    {
        $admin = new Admin();
        $admin->username = 'admin';
        $admin->password = bcrypt('admin123');
        $admin->save();
    }
}

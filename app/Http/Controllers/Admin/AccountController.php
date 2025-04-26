<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    // view thay đổi mật khẩu
    public function changePasswordView()
    {
        return view('admin.account.changePwd');
    }

    //xử lý thay đổi mật khẩu
    public function changePassword(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min:6|same:new_password_confirmation',
            'new_password_confirmation' => 'required',
        ];
        $fields = [
            'current_password' => 'Mật khẩu hiện tại',
            'new_password' => 'Mật khẩu mới',
            'new_password_confirmation' => 'Xác nhận mật khẩu mới',
        ];
        $request->validate($rules,[], $fields);

        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::findOrFail($id);

        if (Hash::check($data['current_password'], $admin->password)) {
            $admin->password = Hash::make($data['new_password']);
            $admin->save();

            $request->session()->regenerate();

            $msg = 'Mật khẩu của bạn đã được cập nhật thành công!';
            if ($request->session()->has('url.intended')) {
                return redirect()->intended($request->session()->get('url.intended'))->with('success', $msg);
            }
            return redirect()->route('admin.dashboard')->with('success', $msg);
        } else {
            $msg = 'Mật khẩu hiện tại không đúng!';
            return back()->with('error', $msg);
        }
    }
}

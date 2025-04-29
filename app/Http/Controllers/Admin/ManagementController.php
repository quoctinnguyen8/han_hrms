<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ManagementController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        if(Auth::guard('admin')->user()->is_account_mnt == 0) {
            abort(403, 'Bạn không có quyền truy cập vào trang này.');
        }
    }
    public function index()
    {
        $adminList = Admin::select([
            'id',
            'username',
            'is_account_mnt',
            'is_leave_mnt',
            'is_quit_job_mnt',
            'is_del_empl'
        ])->paginate();
        return view('admin.management.index', compact('adminList'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:30',
            'password' => 'required|string|min:8|confirmed',
            'is_account_mnt' => 'boolean',
            'is_leave_mnt' => 'boolean',
            'is_quit_job_mnt' => 'boolean',
            'is_del_empl' => 'boolean',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        Admin::create($validatedData);
        return redirect()->route('admin.management.index')->with('success', 'Tạo tài khoản admin thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.management.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:30',
            'password' => 'nullable|string|min:8|confirmed',
            'is_account_mnt' => 'boolean',
            'is_leave_mnt' => 'boolean',
            'is_quit_job_mnt' => 'boolean',
            'is_del_empl' => 'boolean',
        ]);
        $admin = Admin::findOrFail($id);
        if(!$request->filled('is_del_empl')) {
            $validatedData['is_del_empl'] = 0;
        }
        if(!$request->filled('is_account_mnt')) {
            $validatedData['is_account_mnt'] = 0;
        }
        if(!$request->filled('is_leave_mnt')) {
            $validatedData['is_leave_mnt'] = 0;
        }
        if(!$request->filled('is_quit_job_mnt')) {
            $validatedData['is_quit_job_mnt'] = 0;
        }
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
        if($admin->is_account_mnt == 1) {
            return redirect()->route('admin.management.index')->with('error', 'Bạn không có quyền cập nhật tài khoản admin này.');
        }
        $admin->update($validatedData);
        return redirect()->route('admin.management.index')->with('success', 'Cập nhật tài khoản admin thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::guard('admin')->user()->is_account_mnt == 1) {
            return redirect()->route('admin.management.index')->with('error', 'Bạn không có quyền xóa tài khoản admin này.');
        }
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.management.index')->with('success', 'Xóa tài khoản admin thành công');
    }
}

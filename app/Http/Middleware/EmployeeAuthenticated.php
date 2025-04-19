<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmployeeAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();
        $isLoginRoute = in_array($routeName, ['employee.login', 'employee.postLogin']);
        $isAuthenticated = Auth::guard('employee')->check();

        // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập và không phải là trang đăng nhập
        if (!$isAuthenticated && !$isLoginRoute) {
            return redirect()->route('employee.login')
            ->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        
        // Chuyển hướng đến trang thông tin cá nhân nếu đã đăng nhập
        if ($isAuthenticated && $isLoginRoute) {
            return redirect()->route('employee.profile.detail');
        }

        return $next($request);
    }
}

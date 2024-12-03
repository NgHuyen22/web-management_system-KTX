<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAutheticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        //sv
            $sv = $request->session()->get('student_id');
            $sv1 = $request->session()->get('hoten_sv');
            $result = substr($sv, 9);
            if (!$sv && !$sv1 && !$result == 'sv') {
                // Nếu chưa đăng nhập, kiểm tra nếu yêu cầu là JSON
                if ($request->expectsJson()) {
                    // Trả về null nếu yêu cầu là JSON
                    return null;
                } else {
                    // Nếu không phải là yêu cầu JSON, kiểm tra URL
                    if ($request->is('student*')) {
                        // Nếu URL yêu cầu là cho sinh viên, chuyển hướng đến đăng nhập sinh viên
                        return redirect()->route('student.login');
                    } else {
                        // Nếu không phải, chuyển hướng đến đăng nhập admin
                        return redirect()->route('admin.login');
                    }
                }
            }
            return $next($request);
        }

}

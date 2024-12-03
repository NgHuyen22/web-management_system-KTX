<?php


    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    
class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        $value = $request->session()->get('cbql_id');
        $value1 = $request->session()->get('hoten');
        //sv
    
        $result = substr($value,6);
     
        if (!$value && !$value1 && !$result == 'cb' ) {
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

        // Nếu đã đăng nhập, tiếp tục xử lý yêu cầu
        return $next($request);
    }
}


// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class Authenticate
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Kiểm tra xem người dùng đã đăng nhập chưa
//         $cbqlId = $request->session()->get('user_id');
//         $cbqlHoten = $request->session()->get('hoten');
//         //sv
//         $studentId = $request->session()->get('student_id');
//         $studentHoten = $request->session()->get('hoten_sv');

//         // Kiểm tra nếu đang truy cập vào URL của sinh viên
//         if ($request->is('student*')) {
//             // Kiểm tra đăng nhập cho sinh viên
//             if (!$studentId || !$studentHoten) {
//                 // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập sinh viên
//                 return redirect()->route('student.login');
//             }
            
//             // Kiểm tra nếu người dùng admin đã đăng xuất
//             if (!$cbqlId || !$cbqlHoten) {
//                 // Nếu không đăng nhập bằng tài khoản admin, chuyển hướng đến trang đăng nhập admin
//                 return redirect()->route('admin.login');
//             }
//         }

//         // Kiểm tra nếu đang truy cập vào URL của người dùng thông thường
//         if ($request->is('admin/login')) {
//             // Kiểm tra đăng nhập cho quản trị viên
//             if (!$cbqlId || !$cbqlHoten) {
//                 // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập quản trị viên
//                 return redirect()->route('admin.login');
//             }
//         }
        

//         // Nếu đã đăng nhập, tiếp tục xử lý yêu cầu
//         return $next($request);
//     }
// }

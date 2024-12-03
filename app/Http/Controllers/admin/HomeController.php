<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cbql;
use App\Models\student;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public $cbql;
    public $sv;
    public function __construct(){
        $this -> cbql = new cbql();
        $this -> sv = new student();
    }
    //INDEX ADMIN
    public function index(){
        return view('home');
    }
   
    //LOGIN ADMIN
    public function login(){
        return view('admin.login');
    }

    public function check_login(Request $rq){
    
        $data = $rq -> validate([
            'mscb' => 'required',
            'pass' => 'required',
        ]);

        $check_mscb = $rq -> mscb;
        $a = $check_mscb ."-cb";
        $check_pass = md5($rq->pass);
        $remember = $rq ->remember;
        if (!empty($check_mscb) && !empty($check_pass)) {
            if(!empty($remember)){
                session(['remember_mscb' => $check_mscb]);
               
                session(['remember_pass' => $rq->pass]);
            }
            $existingUser = $this->cbql->getUser($check_mscb, $check_pass);
            if ($existingUser) {

                $hoten = $this->cbql->getHotencb($check_mscb);

                session(['cbql_id' =>$a ]);
               
                session(['hoten' => $hoten]);
            
                // Redirect đến trang chính sau khi đăng nhập thành công
                return redirect('/');
            
            }
             else {
            // Xử lý khi thông tin đăng nhập không hợp lệ
            return redirect()->route('admin.login')->with('error', 'Thông tin không chính xác, vui lòng nhập lại!!');
             }
          }
     }
                public function logout(){
                    session()->forget('cbql_id');
                    session()->forget('hoten');
                    // Auth::logout();
                    return redirect()->route('admin.login');
                }

        //LOGIN SV        
        
    public function login_student(){
        return view('student.login');

    }

    public function check_login_student(Request $rq){

        $data = $rq -> validate([
            'mssv' => 'required',
            'pass' => 'required',
        ]);

        $check_mssv = $rq -> mssv;
        $check_pass = md5($rq->pass);
        $remember = $rq ->remember;

        if(!empty($check_mssv) && !empty($check_pass)){
            if(!empty($remember)){
                session(['remember_mssv' => $check_mssv]);
               
                session(['remember_pass_sv' => $rq->pass]);
            }
            $existingUser = $this ->sv ->getUserSv($check_mssv,$check_pass) ;
            $a =$check_mssv."-sv";
           
            if($existingUser){
                $hoten = $this->sv->getHotenSv($check_mssv);
                 session(['student_id' => $a]) ;
                session(['hoten_sv' => $hoten]);
            
                return redirect() ->route('student_index');
              
            }
            else{
               
                 return redirect()->route('student.login') -> with('error','Thông tin không chính xác, vui lòng nhập lại !!');//withInput để giữ lại giá trị vừa ms nhập nếu lỗi
            }
        }
    }

    public function logoutSv(){
        session()->forget('student_id');
        session()->forget('hoten_sv');
        // Auth::logout();
        // Session::flush();
        
        // return redirect(url()->previous());
        return redirect()->route('student.login');
    }


}

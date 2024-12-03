<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cbql;
use App\Models\student;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

    public $cbql;
    public $sv;
    public function __construct(){
        $this->cbql = new cbql();
        $this->sv = new student();
    }

    public function insert(){
    
        return view('admin.addUser');
    }

    public function insertCB(Request $rq){
     
            $dataAddCb = [
                'mscb' => $rq->input('mscb'),
                'hoten' => $rq->input('hoten'),
                'gioitinh' => $rq->input('gioitinh'),
                'chucvu' => $rq->input('chucvu'),
                'email' => $rq->input('email'),
                'password' => $rq->input('pass'),
            ];
        
            $success= $this->cbql->addCbql($dataAddCb);
            if($success){
                echo "Thêm thành công";
            }
    }
    
    public function form_add_sv(){
        return view("student.addUser");
    }

    public function insertSV(Request $rq){
     
        $dataAddSv = [
            'mssv' => $rq->input('mssv'),
            'ho_tenSV' => $rq->input('hoten'),
            'email' => $rq->input('email'),
            'password' => $rq->input('pass'),
            'nganh_hoc' => $rq->input('nganhhoc'),
            'ngay_sinh' => $rq->input('ngaysinh'),
            'gioi_tinh' => $rq->input('gioitinh'),
            'sv_ktx' => $rq->input('sv_ktx'),
        ];
    
        $success= $this->sv->addsv($dataAddSv);
      
        if($success){
            echo "Thêm thành công";
        }
}
}

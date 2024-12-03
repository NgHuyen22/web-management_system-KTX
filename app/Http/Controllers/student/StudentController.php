<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\room_registration;
use App\Models\student;
use App\Models\form;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public $room_m;
    public $sv;
    public $form;
    public function __construct(){
        $this -> room_m = new room_registration();
        $this -> sv = new student();
        $this -> form = new form();
    }

    public function student_index(){
        return view('student.home');
    }

    public function room_registration(Request $rq){
        $room = new room_registration();

        $rooms = $room -> getAllRoom();
        $roomAll = $room -> getRoom();
        $room_type = $room -> getRoomType();
        $buildings = $room ->getBuilding();
        $gender = $room -> getGender();

        $findData = [];
        if(!empty($rq -> maday) && ($rq -> maday != 'Chọn...')){
            $findData[] = ['rm.ma_day',$rq -> maday];
        }

        if(!empty($rq -> maphong) && ($rq -> maphong != 'Chọn...')){
            $findData[] = ['rm.ma_phong',$rq -> maphong];
        }

        if(!empty($rq -> maloaiphong) && ($rq -> maloaiphong != 'Chọn...')){
            $findData[] = ['rm.ma_loai',$rq -> maloaiphong];
        }

        if(!empty($rq -> namornu) && ($rq -> namornu != 'Chọn...')){
            $findData[] = ['rm.phong_nam_nu',$rq -> namornu];
        }
       
        if(!empty($rq -> trangthai) && ($rq -> trangthai != 'Chọn...')){
            $findData[] = ['rm.trang_thai',$rq -> namornu];
        }

        if(empty($findData)){
            $rooms = $this -> room_m -> getAllRooms();
        }
        else{
            $rooms = $this -> room_m -> getAllRoom($findData);
        }
       
        return view('student.register.room_registration.room_registration',compact('rooms','buildings','roomAll','room_type','gender')); 
    }

    public function profile(){
        if(session('student_id')){
            $sv_id = session('student_id');
            $result = substr($sv_id, 0,8);
        
            $profile = $this ->sv->getProfileSV($result);
            $maloai = $this ->form -> getTypeForm();
            $maloai2 = $this ->form ->getChangeRoom();
            $maloai3 = $this ->form ->getTypeGiveBackRoom();
            $mssv = substr(session('student_id'),0,8);
            
            $form = $this->sv->getFormMssv($mssv,$maloai);
            $form_changes = $this->sv->getFormMssv($mssv,$maloai2);
            $form_give_back = $this ->sv-> getFormMssv($mssv,$maloai3);
            $countform = $this->form->countForm($mssv,$maloai);
            $countChangesForm = $this->form->countForm($mssv,$maloai2);
            $countGiveBackForm = $this->form->countForm($mssv,$maloai3);
           
            
        //   dd($form_give_back);
            // $cancleForm = $this->form->cancleForm();
           //dd($form);
            return view('student.view_profile.view_profile',compact('profile','form','form_changes','form_give_back','countform','countChangesForm','countGiveBackForm'));
        }
        else{
            return redirect()->route('student_index')->with('error','Lỗi! Không truy xuất được thông tin ');
        }
    }

    public function cancle_form(){
        $mssv = substr(session('student_id'),0,8);
        $rs =$this -> form-> cancleForm($mssv);
            // if($rs == null){
            //     $this->bill->deleteBillRegister()
            // }

        sleep(2);
        return back() ;
    }

    public function cancle_form_changes(){
        $mssv = substr(session('student_id'),0,8);
        $this -> form-> cancleFormChanges($mssv);
        sleep(2);
        return back() ;
    }
    public function cancle_form_giveback(){
        $mssv = substr(session('student_id'),0,8);
        $this -> form-> cancleFormGiveBack($mssv);
        sleep(2);
        return back() ;
    }

}

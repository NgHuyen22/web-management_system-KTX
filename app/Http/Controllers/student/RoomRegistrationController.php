<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Models\room_management;
use App\Models\room_registration;
use App\Models\form;
use App\Models\bills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomRegistrationController extends Controller
{
    protected const _per_page =5;
    public $room_m;
    public $room_sv;
    public $form;
    public $bill;
    public function __construct(){
        $this -> room_m= new room_management();
        $this -> room_sv= new room_registration();
        $this -> form= new form();
        $this -> bill= new bills();
    }

    

    public function room_registration(Request $rq){
        // $room = new room_management();
        $maphong = $rq ->ma_phong;
        $room_sv = new room_registration();

        $rooms = $room_sv -> getAllRoom();
        $roomAll = $room_sv -> getRoom();
        $room_type = $room_sv -> getNameRoomType();
        $buildings = $room_sv ->getBuildingSv();
        $gender = $room_sv -> getGender();
        $status = $room_sv -> getStatus();
        $khu = $room_sv ->getAllKhuUsing();
       
        // $trong = $room ->getEmpty();
        // $stt = $stt -> getStatus();

        $mssv = substr(session('student_id'),0,8);
        $id_form = $this->form->getIDForm_Mssv($mssv);
        $id_not_approved_register = $this ->form->getIDForm_not_approved_register($mssv);
        $id_approved_register = $this ->form ->getIDForm_approved_register($mssv);
        $id_unapprove_changes_form = $this -> form -> getIDFormUnapproveChanges($mssv);
        // $full_room = $this ->room_sv->getSLRoom($maphong); 
       
        $findData = [];
        if(!empty($rq -> tenday) && ($rq -> tenday != 'Chọn...')){
            $findData[] = ['rm.ma_day',$rq -> tenday];
        }

        if(!empty($rq -> maphong) && ($rq -> maphong != 'Chọn...')){
            $findData[] = ['rm.ma_phong',$rq -> maphong];
        }

        if(!empty($rq -> tenloaiphong) && ($rq -> tenloaiphong != 'Chọn...')){
            $findData[] = ['rt.ten_loai_phong',$rq -> tenloaiphong];
        }

        if(!empty($rq -> namornu) && ($rq -> namornu != 'Chọn...')){
            $findData[] = ['rm.phong_nam_nu',$rq -> namornu];
        }
       
        if(!empty($rq -> trangthai) && ($rq -> trangthai != 'Chọn...')){
            $findData[] = ['rm.trang_thai',$rq -> trangthai];
        }
        //dd($findData);
        
        // if (!empty($rq->tuychon)) {

        //     if ($rq->tuychon == '1') {
        //         $findData[] = ['rm.con_trong', '>', 0]; 
        //         // $findData[] = DB::raw('(rm.so_cho - rm.da_o) > 0');
        //     } else{
        //         // dd($findData);
            
        //         $findData[] = ['rm.con_trong', '=', 0];
        //         // dd($findData);
        //     }
        // }
     
        if(empty($findData)){
            // $rooms = $this -> room_m -> getAllRooms();
            $rooms = $this->room_sv->getAllRoomsStudent(self::_per_page);
        }
        else{
            // $rooms = $this -> room_m -> getAllRoom($findData);
            $rooms = $this->room_sv->getAllRoomStudent($findData,self::_per_page);
        }
       
        return view('student.register.room_registration.room_registration',compact('rooms','buildings','roomAll','room_type','gender','status','id_form','id_not_approved_register','id_approved_register','id_unapprove_changes_form'
                                                                                                                            ,'khu')); 
    }


    public function create_form(Request $rq){
        $maphong = $rq ->maphong_register;
        $tenphong = $this -> room_sv ->getNameRoom($maphong);
        $tenday = $this ->room_sv ->getNamBuilding($maphong);
        $khu = $this ->room_sv ->getNameArea($maphong);
        $loaiphong = $this ->room_sv ->getNameRoomType_id($maphong);
        $gender = $this ->room_sv ->getGender_id($maphong);
        $gia = $this ->room_sv ->getPriceRoom($maphong);
        $namhoc = $this ->form ->getSchoolYear();
        $full_room = $this ->room_sv->getSLRoom($maphong); 
        $stt_room = $this -> room_sv ->getSttRoom($maphong);
       
        // dd($full_room);
        if($full_room == 0 || $stt_room == 'Chưa sử dụng'){
            if($full_room == 0){

                return redirect()->route('student.register.room_registration')->with('error', 'Phòng đã hết chỗ !');
            }
            elseif($stt_room == 'Chưa sử dụng'){
                return redirect()->route('student.register.room_registration')->with('error', 'Phòng chưa được sử dụng !');
            }
       } 
       else{

           return view('student.register.room_registration.create_form',compact('maphong','tenphong','tenday','khu','loaiphong','gender','gia','namhoc'));
       }
    }
    
    public function insert_form(Request $rq){
        $maphong = $rq -> maphong;
        $ngaytao = now()->format('Y-m-d');
        
        $maloai = $this ->form -> getCodeTypeRoom($maphong);
        $hk=$rq->hk;
        $nh=$rq->nh;
        
        $stt_hk_nh = $this ->form -> getStt_Hk_Nh($hk,$nh);
        $mssv = substr(session('student_id'),0,8);
        $loai_don = $this->form->getRoomRegistration();
        $full_room = $this ->room_sv->getSLRoom($maphong); 
        
   
        
        $data = [
            $ngaytao,
            $loai_don,
            $mssv,
            $maphong,
            $stt_hk_nh,
        ]; 
        $tenhd ='Phí phòng';
        
     

            if ($stt_hk_nh !== null) {
            

                    $this->form->addForm($data);
                  
                 
                    sleep(3);
                    return redirect()->route('student.profile');
                

            }  else{
                
                sleep(2);
                //  return redirect()->route('student.register.room_registration')->with('error', 'Đăng ký thất bại;');
            }  
        }
        
        public function create_form_changes(Request $rq){
            $maphong = $rq ->maphong_register;
            $tenphong = $this -> room_sv ->getNameRoom($maphong);
            $tenday = $this ->room_sv ->getNamBuilding($maphong);
            $khu = $this ->room_sv ->getNameArea($maphong);
            $loaiphong = $this ->room_sv ->getNameRoomType_id($maphong);
            $gender = $this ->room_sv ->getGender_id($maphong);
            $gia = $this ->room_sv ->getPriceRoom($maphong);
            $namhoc = $this ->form ->getSchoolYear();
            $full_room = $this ->room_sv->getSLRoom($maphong); 
            $stt_room = $this -> room_sv ->getSttRoom($maphong);
           
            // dd($full_room);
            if($full_room == 0 || $stt_room == 'Chưa sử dụng'){
                if($full_room == 0){
    
                    return redirect()->route('student.register.room_registration')->with('error', 'Phòng đã hết chỗ !');
                }
                elseif($stt_room == 'Chưa sử dụng'){
                    return redirect()->route('student.register.room_registration')->with('error', 'Phòng chưa được sử dụng !');
                }
           } else{

           }
           return view('student.register.room_registration.create_form_changes',compact('maphong','tenphong','tenday','khu','loaiphong','gender','gia','namhoc'));
          
        }
   
        public function changes_room(Request $rq){
            $maphong = $rq -> maphong;
            $ngaytao = now()->format('Y-m-d');
            
            $maloai = $this ->form -> getCodeTypeRoom($maphong);
            $hk=$rq->hk;
            $nh=$rq->nh;
            
            $stt_hk_nh = $this ->form -> getStt_Hk_Nh($hk,$nh);
            $mssv = substr(session('student_id'),0,8);
            $loai_don = $this->form->getChangeRoom();

            $data = [
                $ngaytao,
                $loai_don,
                $mssv,
                $maphong,
                $stt_hk_nh,
            ]; 
        

        if ($stt_hk_nh !== null) {
                $exitsRoomChanges = $this ->form ->getIDFormApproved($mssv);
            // if($exitsRoomChanges){
            //       return redirect() ->route('student.register.room_registration')->with('error','Thất bại ! Vui lòng chọn phòng khác phòng hiện tại');
            // }
            if ($exitsRoomChanges != null) {
                if($maphong == $exitsRoomChanges->ma_phong){
                        return redirect() ->route('student.register.room_registration')->with('error','Thất bại ! Vui lòng chọn phòng khác phòng hiện tại');
                    }else{
    
                        $this->form->addForm($data);
                        //dd($success);
                        sleep(3);
                        return redirect()->route('student.profile');
                    }
            }
        }  else{
                sleep(2);
        }  
      }

      public function create_give_back_form(Request $rq){
           
          $ngaytao = now()->format('Y-m-d');
          
         // $maloai = $this ->form -> getCodeTypeRoom($maphong);
         
          
        //   $stt_hk_nh = $this ->form -> getStt_Hk_Nh();
          $mssv = substr(session('student_id'),0,8);
          $loai_don = $this->form->getTypeGiveBackRoom();
          $exitsForm = $this ->form->getIDFormApproved($mssv);
          $maphong = $exitsForm -> ma_phong;

            $data = [
                $ngaytao,
                $loai_don,
                $mssv,
                $maphong,
                $exitsForm -> stt_hk_nh,
            ]; 

            $this -> form -> addForm($data);
            // if($give_back){
                sleep(3);
                return back();
            // }
      }
      
      
    }



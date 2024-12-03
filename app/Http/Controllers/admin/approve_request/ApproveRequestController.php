<?php

namespace App\Http\Controllers\admin\approve_request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\form;
use App\Models\csvc_repair_details;
use App\Models\student;
use App\Models\room_management;
use Illuminate\Validation\ValidationException;


class ApproveRequestController extends Controller
{
    public $form;
    public $sv;
    public $room;
    public $csvc_repair;
    public function __construct(){
        $this->form = new form();
        $this->sv = new student();
        $this->room= new room_management();
        $this->csvc_repair= new csvc_repair_details();
    }

    public function approve_request(Request $rq){
        $listNullStt = $this ->form->approveRegister();    
        $listStt = $this ->form->approvedRegister();

        $unapprove_changes_list = $this ->form->unapproveChanges();
        $approve_changes_list = $this ->form->approvedChanges();

        $unapprove_giveback_list = $this->form->unapproveGiveBack();
        $approve_giveback_list = $this->form->approvedGiveBack();

        $unapproved_csvc_list = $this ->csvc_repair-> getAllIDFormRepair();
        $unapproved_csvc_listNull = $this ->csvc_repair-> getAllIDFormRepairNull();
       $approved_csvc_list = $this ->csvc_repair-> getApprovedAllIDFormRepair();
       $approved_csvc_listNull = $this ->csvc_repair-> getApprovedAllIDFormRepairNull();
    //  dd($approved_csvc_listNull);
        
        //ti_le_tat_ca_cac_don
        $countAllForm = $this -> form ->countAllForm();
        $countUnapprove = $this -> form ->countUnapprovedForm();
        $countApproved = $this -> form ->countApprovedForm();

        //ti_le_don_dk_phong
        $countAllRoomRegistration = $this -> form ->countAllRoomRegistration();
        $countUnapproveRoomRegistration = $this -> form ->countUnapproveRoomRegistration();
        $countApproveRoomRegistration = $this -> form ->countApproveRoomRegistration();

        //ti_le_don_dk_chuyen_phong
        $countAllChangeRoom = $this -> form ->countAllChangeRoom();
        $countUnapproveChangeRoom = $this -> form ->countUnapproveChangeRoom();
        $countApproveChangeRoom = $this -> form ->countApproveChangeRoom();

        //ti_le_don_dk_tra_phong
        $countAllGiveBackRoom = $this -> form ->countAllGiveBackRoom();
       
        $countUnapproveGiveBackRoom = $this -> form ->countUnapproveGiveBackRoom();
        $countApproveGiveBackRoom = $this -> form ->countApproveGiveBackRoom();

        //ti_le_don_dk_sua_csvc
        $countAllCsvcRepairForm = $this -> form ->countAllCsvcRepairForm();
      
        $countUnapproveCsvcRepaiForm = $this -> form ->countUnapproveCsvcRepaiForm();
        $countApproveCsvcRepaiForm  = $this -> form ->countApproveCsvcRepaiForm();
    

        
      
        return view('admin.approve request.approve_request',compact('listNullStt','listStt','unapprove_changes_list','approve_changes_list','unapprove_giveback_list','approve_giveback_list','countAllForm','countUnapprove','countApproved',
                 'unapproved_csvc_list','approved_csvc_list','countAllRoomRegistration','countUnapproveRoomRegistration','countApproveRoomRegistration','countAllChangeRoom','countUnapproveChangeRoom','countApproveChangeRoom',
                'countAllGiveBackRoom','countUnapproveGiveBackRoom','countApproveGiveBackRoom','countAllCsvcRepairForm','countUnapproveCsvcRepaiForm','countApproveCsvcRepaiForm','approved_csvc_listNull','unapproved_csvc_listNull'));
    }

    public function acp_room_registration(Request $rq){
        $mssv = substr(session('student_id'),0,8);
        $id_form = $rq -> id;
        $maphong = $this -> form -> getRoomCode($id_form);
        
        $data = [
            'ngay_duyet' => date('Y-m-d H:i:s'),
            'trang_thai' => 1
        ];
        $dataStudent =[
            'sv_ktx' => 1
        ];

        $this -> form->updateSTTNotAcp($data,$id_form);
        $sl_phong= $this -> room -> getSLRoom($maphong);
        $con_trong= $this -> room -> getSLRoom1($maphong);
        // dd($con_trong);
        $sl_phong = $sl_phong + 1 ;
        $con_trong = $con_trong - 1;
        $sl = [
                'da_o' => $sl_phong,
                'con_trong' => $con_trong
        ];
         $this -> room -> updateSLRoom($maphong,$sl);
       
        $this ->sv->addStudentKtx($mssv,$dataStudent);
            sleep(2.5);
            return back();
        
    }

    public function acp_giveback_form(Request $rq){
        $mssv = substr(session('student_id'),0,8);
        $id_form = $rq -> id;
        $data = [
            'ngay_duyet' => date('Y-m-d H:i:s'),
            'trang_thai' => 1
        ];
        $dataStudent =[
            'sv_ktx' => 0
        ];

        $this -> form ->deleteForm($mssv);
        $this -> form->updateSTTNotAcp($data,$id_form);
        $this ->sv->deleteStudentKtx($mssv,$dataStudent);
            sleep(2.5);
            return back();
        
    }

    public function acp_csvc_repair_register(Request $rq){
        $mssv = substr(session('student_id'),0,8);
        $id_form = $rq -> id;
        $data = [
            'ngay_duyet' => date('Y-m-d H:i:s'),
            'trang_thai' => 1
        ];
        $this -> form->updateSTTNotAcp($data,$id_form);
        sleep(2.5);
        return back();
    }

}
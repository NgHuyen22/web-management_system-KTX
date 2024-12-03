<?php
namespace App\Http\Controllers\student;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\csvc;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\csvc_of_room;
use App\Models\csvc_repair_details;
use App\Models\room_registration;
use App\Models\form;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RegisterRepaircsvcController extends Controller
{

    public $csvc_room;
    public $room;
    public $form;
    public $sv;
    public $csvc_repair;
    public function __construct(){
        $this -> csvc_room = new csvc_of_room();
        $this -> csvc_repair = new csvc_repair_details();
        $this ->room = new room_registration();
        $this ->form = new form();
        $this ->sv = new student();
    }
    
    public function register_repair_csvc()
{
    $student_id = session('student_id');
    $mssv = substr($student_id, 0, 8);

    $form = $this->form->getIDFormApproved($mssv);

    if (!$form) {
        return view('student.register.Register_repair_csvc.Register_repair_csvc', compact('form'));
        // return redirect()->route('student.register.register_repair_csvc')->with('error', 'Bạn chưa có phòng');
    }

    $maphong = $form->ma_phong;
    $csvc = $this->csvc_room->getCSVCRoom($maphong);
    $namhoc = $this->form->getSchoolYear();
    $loai_don = 'LD004';
    $allForm = $this->form->getAllIDFormRepair($mssv, $loai_don);
    $formNull = $this->form ->getFormRepairNull($mssv,$loai_don);
    
    $formRepair = $this->form->checkIDFormRepair($mssv, $loai_don);
    $check = $this->form->checkSTTForm($mssv,$loai_don);
    // dd($check);
    return view('student.register.Register_repair_csvc.Register_repair_csvc', compact('maphong', 'csvc', 'namhoc', 'allForm', 'form', 'formRepair','check','formNull'));
}

    public function insert_register_repair(Request $rq){
        $mssv = substr(session('student_id'),0,8);
        $loai_don = 'LD004';
        $hk=$rq->hk;
        $nh=$rq->nh;
        $stt_hk_nh = $this ->form -> getStt_Hk_Nh($hk,$nh);
        $ngaytao = now()->format('Y-m-d');
        $dataForm= [
                $ngaytao,
                $loai_don,
                $mssv,
                $rq ->maphong,
                $stt_hk_nh
        ];
       
        if ($stt_hk_nh !== null) {   
            $this->form->addForm($dataForm);
        
        $findForm = $this -> form -> getIDFormRepair($mssv,$loai_don);
       
        $madon= $findForm ->id;
        
        $dataRepairCSVC =[
            $rq ->csvc,
            $madon,
            $rq ->soluong,
            $rq ->tinhtrang,
            $rq ->maphong
        ];
        // dd($dataRepairCSVC);
         
            if($rq ->csvc ==null ||  $madon == null ||   $rq ->soluong == null || $rq ->tinhtrang==null || $rq ->maphong ==null){
                return redirect()->route('student.register.register_repair_csvc')->with('error','Không để trống thông tin');
            }else{
                if(!is_numeric($rq->soluong) || $rq->soluong <=0){
                    return redirect()->route('student.register.register_repair_csvc')->with('error','Số lượng không hợp lệ !');
                }else{
                        $this -> csvc_repair ->addForm($dataRepairCSVC);
                        sleep(2.5);
                        return back();
                }
            }
        } else{
            sleep(2.5);
            return redirect()->route('student.register.register_repair_csvc')->with('error','Vui lòng chọn học kỳ!');
        }
    }

    public function cancle_csvc_repair_form(Request $rq){
        $mssv = substr(session('student_id'),0,8);
        $ma_sua = $rq -> ma_sua_csvc;
        
        // $exitsForm = $this -> form -> getIDFormRepair($mssv,'LD004');
        
        $exitsFormRepair = $this ->form -> getIDRepairDetails($ma_sua);
        $madon = $exitsFormRepair->ma_don;
        // dd($madon);
        if ($exitsFormRepair){
            $this->csvc_repair->cancleFormRepair($ma_sua);
            $this->form->deleteFormRepair($madon);
            sleep(2.5);
        return redirect()->route('student.register.register_repair_csvc');
        }
    }
}
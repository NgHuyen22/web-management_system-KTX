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
use App\Models\bills;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ViewPaymentStatusController extends Controller
{

    public $form;
    public $bill;
    public function __construct()
    {
        $this ->form = new form();
        $this ->bill = new bills();
    }
    public function view_payment_status1(){
        $mssv = substr(session('student_id'),0,8);
        $id_form = $this->form->getIDForm_Mssv($mssv);
        $id_form_un = $this->form->getIDForm_MssvUn($mssv);
        // dd($id_form_un);
        // $id_form_un = $this->form->getIDForm_MssvUn($mssv);
        $ten_hd ='Phí phòng';
        $id_hd = $this->bill->getContentValue($ten_hd,$mssv);
        // dd($id_form);
         
        return view('student.view_payment_status.view_payment_status1',compact('id_form','id_form_un','mssv','id_hd'));
    }

    public function pay(){
        $mssv = substr(session('student_id'),0,8);
            return view('student.pay.pay',compact('mssv'));
    }

    public function processing(Request $rq){
        $ten_hd = $rq ->ten_hd;
        // $noidung = $rq->content;
        $mssv = $rq ->mssv;
        // dd($mssv);
        $maphong = $rq->ma_phong;
        $trangthai = 1;
        $data=[
            $ten_hd,
            // $noidung,
            $maphong,
            $trangthai,
            $mssv
        ];
        $sc =$this->bill->addBillRoom($data);
        if($sc == null){
            sleep(2.5);
            return redirect()->route('view_payment_status1');
        }else{
            return redirect()->route('pay.processing')->with('error','Lỗi giao dịch thất bại!');
        }
    }
}
<?php

namespace App\Http\Controllers\admin\StudentManagementController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\student;
use App\Models\form;
use App\Models\bills;
use App\Models\csvc_repair_details;
use Illuminate\Pagination\Paginator;
class StudentManagementController extends Controller
{   
    public $sv;
    public $form;
    public $bill;
    public $csvc_repair;
    public function __construct() {
        $this->sv = new student();
        $this->form = new form();
        $this->bills = new bills();
        $this->csvc_repair = new csvc_repair_details();
    }

    public function delete_sv(Request $rq){
        $mssv = $rq -> mssv;
    //    dd($mssv);
        $dataStudent =[
            'sv_ktx' => 0
        ];
        $this -> form ->deleteForm($mssv);
        $this ->sv->deleteStudentKtx($mssv,$dataStudent);
        sleep(2.5);
        return back();
    }

    public function checked_delete_sv(Request $rq){
        $mssv= $rq -> mssv;
        // dd($mssv);
        $dataStudent =[
            'sv_ktx' => 0
        ];
        if(is_array($mssv) && !empty($mssv)) {
            foreach($mssv as $studentMssv) {
                $loai= 'LD004';
                $madon = $this->form->getMaDonRepair($mssv,$loai);
                foreach($madon as $don){
                   
                    $this->csvc_repair->deleteForm($don->id);
                    
                }
                $this -> form ->deleteForm($mssv);
                // $this -> bill ->setNullHD_SV($mssv);
                $this->sv->deleteStudentKtx($studentMssv,$dataStudent);
              
            }
        }
         sleep(2.5);
        return back();
    }
}
<?php

namespace App\Http\Controllers\admin\Csvc_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\student;
use App\Models\form;
use App\Models\room_management;
use App\Models\csvc_of_room;
use App\Models\csvc_repair_details;
use App\Models\csvc;
use Illuminate\Pagination\Paginator;

class CSVCManagementController extends Controller
{   
    public $csvc_r;
    public $csvc;
    public $csvc_repair;
    public $room;
    public function __construct()
    {
        $this ->csvc_r = new csvc_of_room();
        $this ->csvc = new csvc();
        $this ->csvc_repair = new csvc_repair_details();
        $this ->room = new room_management();
    }

   public function delete_csvc_room(Request $rq){
        $ma_csvc = $rq -> ma_csvc;
        
       
        $delete = $this->csvc_r->deleteCSVC_Room($ma_csvc);
        // dd($delete);
        if($delete == null){
            return redirect()->route('csvc_management') ->with('success','Xóa thành công!');
        }
        else{
            return redirect()->route('csvc_management') ->with('error','Lỗi không thể xóa, thử lại sau');
        }

    }

    public function add_csvc_room(){
        $csvc = $this->csvc->getCSVCRoom();
        $phong = $this ->room->getRoomName();
        $day = $this ->room->getHideIDBui();
        
        
        return view('admin.csvc_management.add_csvc_room',compact('csvc','phong','day'));
    }
    public function insert_csvc_room(Request $rq){
        $ma_csvc = $rq -> ten_csvc;
        $maphong = $this ->room->findIDRoom($rq->ten_phong,$rq->day);
    //    dd($maphong);
        $sl = (int) $rq->so_luong;
        // $data=[
        //    'ma_csvc'=> $ma_csvc,
        //     'ma_phong'=>$maphong,
        //     'so_luong' => $sl
        // ];
        $data=[
            $ma_csvc,
            $maphong,
            $sl
        ];
        $sl_tong = $this->csvc->getSLCSVC($ma_csvc);
        if($rq->so_luong !=null){
            if($rq->so_luong >$sl_tong || $rq->so_luong <=0){
                if($rq->so_luong >$sl_tong){
                    return redirect() ->route('csvc_management')->with('error',"Số lượng đã vượt quá");
                }else if($rq->so_luong <=0){
                    return redirect() ->route('csvc_management')->with('error',"Số lượng khác 0 và lớn hơn 0");
                }
            }else{
                $this -> csvc_r->add($data);
                // $sl_tong = $sl_tong - $sl;
               
                
                // $this->csvc->UpdateSL($sl_tong,$ma_csvc);
                return redirect() ->route('csvc_management')->with('success',"Thêm csvc vào phòng thành công");
            }
            
        }

    }
    public function edit_csvc_room(Request $rq,$ma_csvc){
        $ma_csvc = $ma_csvc;
        $csvc = $this->csvc->getCSVC($ma_csvc);
      
       
        return view('admin.csvc_management.edit_csvc_room_form',compact('ma_csvc','csvc'));
        // return view('admin.approve request.approve_request');
    }
    public function update_csvc(Request $rq){
        
   
        $ma_csvc = $rq -> ma_csvc;
       
        $ten_csvc = $rq -> ten_csvc;
        $sl = $rq -> so_luong;
        $dataUpdate =[
            'ten_csvc'=>$ten_csvc,
            'so_luong' => $sl
        ];
        $update = $this-> csvc -> updateCsvc($dataUpdate,$ma_csvc);
        return redirect()->route('csvc_management')->with('success','Cập nhật thành công!');
    }

    public function delete_csvc(Request $rq){
        $ma_csvc = $rq ->ma_csvc;
        $deleteCsvcRoom =  $this->csvc_r->deleteCSVC_Room($ma_csvc);
        $dataNull =[
            'ma_csvc'=>NULL
        ];
         $this ->csvc_repair->SetNull($dataNull,$ma_csvc);
        $delete = $this ->csvc->deleteCsvc($ma_csvc);
        if($delete == NULL){
            sleep(2.5);
            return redirect()->route('csvc_management');
        }
    }
}

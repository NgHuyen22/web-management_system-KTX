<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\room_managemnt\RoomManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\area_management;
use App\Models\room_management;
use App\Models\cbql;
use App\Models\student;
use App\Models\csvc;
use App\Models\csvc_of_room;
use App\Models\bills;
use Illuminate\Pagination\Paginator;



class AdminController extends Controller
{   
    protected const _per_page =5;

    public function index(Request $rq){
        // $area = DB::select('SELECT * FROM ql_khus ORDER BY ma_khu ASC');
        $areaModel= new area_management();
        $keywords = $rq-> keywords;
        $area = $areaModel->getArea($keywords);
        return view('admin.area_management.area_index',compact('area')); // truyền biến vào mảng mảng , mảng này truyền vào view để có thể truy câp  trong template , biến này ms có thể dc sử dụng trong view đó
    }

    public $room_m;
    public $cbql;
    public $sv;
    public $csvc;
    public $csvc_r;
    public $bill;
    public function __construct(){
        $this->room_m = new room_management();
        $this->cbql = new cbql();
        $this->sv = new student();
        $this->csvc = new csvc();
        $this->csvc_r = new csvc_of_room();
        $this->bill = new bills();
    }

    public function room(Request $rq){
        $room = new room_management();
        $khu = $room ->getAllKhuUsing();
        // $khunouse = $room ->getAllKhuNoUse();
        $khunouse = $room ->getAllKhuNoUse();
        // dd($khunouse);
        $rooms = $room -> getAllRoom();
    
        $roomAll = $room -> getRoom();
        $room_type = $room -> getRoomType();
        // $room_type_name = $room->getHideIDRoomType();
        $room_type_name = $room->getNameRoomType();
        // dd($room_type_name);
        $buildings = $room ->getBuilding();
        $gender = $room -> getGender();
        $status = $room->getStatus();


        $findData = [];
        if(!empty($rq -> maday) && ($rq -> maday != 'Chọn...')){
            $findData[] = ['rm.ma_day',$rq -> maday];
        }

        if(!empty($rq -> maphong) && ($rq -> maphong != 'Chọn...')){
            $findData[] = ['rm.ma_phong',$rq -> maphong];
        }

        // if(!empty($rq -> maloaiphong) && ($rq -> maloaiphong != 'Chọn...')){
        //     $findData[] = ['rm.ma_loai',$rq -> maloaiphong];
        // }
        if(!empty($rq -> tenloaiphong) && ($rq -> tenloaiphong != 'Chọn...')){
            $findData[] = ['rt.ten_loai_phong',$rq -> tenloaiphong];
        }

        if(!empty($rq -> namornu) && ($rq -> namornu != 'Chọn...')){
            $findData[] = ['rm.phong_nam_nu',$rq -> namornu];
        }

        if(!empty($rq -> trangthai) && ($rq -> trangthai != 'Chọn...')){
            $findData[] = ['rm.trang_thai',$rq -> trangthai];
        }

        if (!empty($rq->khu)) {

            if ($rq->khu != '1') {
                $findData[] = ['d.ma_khu', $rq->khu]; 
                // dd($findData);
               
                // $findData[] = DB::raw('(rm.so_cho - rm.da_o) > 0');
            }else{
               
                // $khunouseArray = $khunouse->pluck('ma_phong')->toArray(); // Chuyển đổi danh sách stdClass thành mảng
                // $findData[] = ['d.ma_khu', $khunouse];
                $findData[] = ['d.ma_khu', $khunouse];
                // dd($khunouse);
            }
        }
        if (empty($findData)) {
            $rooms = $this->room_m->getAllRooms(self::_per_page);
            // dd($rooms);
        } else {
            $rooms = $this->room_m->getAllRoom($findData,self::_per_page);
        //    dd($rooms);
        }

     
        return view('admin.room_management.room_index',compact('rooms','buildings','roomAll','room_type','gender','status','room_type_name','khu')); 
    }

    public function profile(Request $rq){
                if(session('cbql_id')){
                    $cbql_id = session('cbql_id');
                    $result = substr($cbql_id, 0,5);
                    $profile = $this ->cbql->getProfileCB($result);
                  
                    return view('admin.view profile.view_profile',compact('profile'));
                }
                else{
                    return redirect('/')->with('error','Lỗi! Không truy xuất được thông tin ');
                }
    }

    public function student_management(Request $rq){

            $profile_sv = $this -> sv -> getProfileAllSV(3);
            $all_students = $this->sv->getAllStudents();
            // $total_students = count($all_students);
            // $profile_sv_mp=  $this -> sv -> getProfileAllSV();
            $keywords = $rq -> keywords;
            $profile_sv = $this -> sv->searchSV($keywords);
            // dd($keywords);
            return view('admin.student_management.student_management',compact('profile_sv','all_students'));
    }

   public function csvc_management(Request $rq){
            $keywords = $rq-> keywords;
            $allCsvcList = $this ->csvc->getAllCSVCList($keywords);
            $allCsvc_RoomList = $this->csvc_r->getallCsvc_RoomList();
            // dd($allCsvc_RoomList);
            $all_csvc = $this->csvc->countCSVC();
            
          
            // $search = $this ->csvc->SearchKeywords($keywords);
            // dd($search);
            return view('admin.csvc_management.csvc_management',compact('allCsvcList','allCsvc_RoomList','all_csvc'));
   }

   public function bills_management(){

        $id = $this ->bill->getAll();
        $idNotNull = $this ->bill->getAllNotNull();
        // dd($idNotNull);
        // dd($id);
        return view('admin.bills_management.bill_management',compact('id','idNotNull'));
   }
}

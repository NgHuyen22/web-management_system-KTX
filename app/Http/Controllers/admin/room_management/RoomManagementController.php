<?php

namespace App\Http\Controllers\admin\room_management;

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\room_management;
use App\Models\csvc_of_room;
use App\Models\form;
use App\Models\bills;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class RoomManagementController extends Controller
{
 

    protected $table = 'room_management';
    
    public $room_m;
    public $csvc_r;
    public $form;
    public $bill;
    public function __construct(){
        $this -> room_m = new room_management();
        $this -> csvc_r = new csvc_of_room();
        $this -> form = new form();
        $this -> bill = new bills();

    }

    public function add_room(){
        $room = new room_management();
      
        $room_type = $room -> getRoomType();
        $buildings = $room->getBuilding();
        $gender = $room-> getGender();
        $status =  $room-> getStatus();
      
        return view('admin.room_management.add_room',compact('room_type','buildings','gender','status' ));
    }

        public function save_room(Request $rq){
          
            $existingRoom = room_management::where('ma_phong', $rq->maphong)->first();
    
            if ($existingRoom) {
                return redirect()->route('room_management.add_room')->with('error', 'Mã phòng đã tồn tại, vui lòng nhập mã phòng khác !');
            } else {
                $dataAddRoom = $rq -> all();
                $numberSlot = intval($dataAddRoom['socho_tt']); //intval chuyen doi gia tri thanh so nguyen
                $quantity = intval($dataAddRoom['da_o']);
                $dataAddRoom['con_trong'] = $numberSlot - $quantity;

               $existingRoomNameAndBuildingCode = room_management::where('ten_phong', $rq->input('tenphong'))
                ->where('ma_day', $rq->input('maday'))
                ->first();

                if ($existingRoomNameAndBuildingCode) {
                    return back()->with('error', 'Đã tồn tại, vui lòng nhập mã dãy hoặc tên phòng khác !');
                } else {
                    $room = $this->room_m ->addRoom($dataAddRoom);
                
                    if ($room) {
                        sleep(2);
                        return redirect()->route('room_management.add_room');
                    } else {
                        return redirect()->route('room_management.add_room')->with('error', 'Đã có lỗi xảy ra khi thêm phòng !');
                    }
            }
            }
        }

        public function form_edit(Request $rq){
                $roomcode = $rq -> maphong;
                $show_roomcode = room_management::where('ma_phong',$roomcode) ->first();
                // dd($tenkhu);
                // dd($hienmakhu);
                if ($show_roomcode) {
                    $roomname = $show_roomcode ->ten_phong;
                    $typecode = $show_roomcode ->ma_loai;
                    $buildingcode = $show_roomcode ->ma_day;
                    $genderroom = $show_roomcode ->phong_nam_nu;
                    $numberseats = $show_roomcode ->so_cho;
                    $currentroom= $show_roomcode ->da_o;
                    $emptyroom = $show_roomcode ->con_trong;
                    $statusroom = $show_roomcode ->trang_thai;

                    $room_type = $this -> room_m -> getRoomType();
                    $room_code = $this ->room_m -> getRoom();
                    $room_name = $this ->room_m -> getRoomName();
                    $building_room = $this -> room_m ->getBuilding();
                    $gender_room = $this -> room_m ->getGender();
                    $status_room = $this -> room_m ->getStatus();
                   
                   return view("admin.room_management.form_edit_room", 
                             compact('roomcode','show_roomcode','roomname','typecode','buildingcode','genderroom','numberseats','currentroom','emptyroom',
                             'statusroom','room_type','room_code','building_room','gender_room','status_room','room_name'));
                } else {
                    return back()->with('error', 'Không có mã khu để sửa');
                }
        }

    // protected const _per_page =5;
    public function update_room(Request $rq){
                $maphong = $rq -> maphong;
                $dataUpdate = [
                    // 'ten_phong' => $rq -> tenphong,
                    'ma_loai' => $rq -> maloaiphong,
                    'ma_day' => $rq -> maday,
                    'phong_nam_nu' => $rq -> phongnam_nu,
                    'trang_thai' => $rq -> trangthai,
                    'so_cho' => $rq -> socho_tt,
                    'con_trong' => $rq -> controng,
                    'da_o' => $rq -> da_o
                ];

        
                    // if(!empty($rq ->tenphong)){
                        // $exitstingRoomName = room_management::where('ten_phong', $rq -> tenphong) -> first();
                        // $exitstingBuildingCode = room_management::where('ma_day', $rq -> maday) -> first();
                        
                        // if ($exitstingRoomName && $exitstingBuildingCode) {
                        //         return back() -> with('error', 'Đã tồn tại, vui lòng nhập mã dãy hoặc tên phòng khác !');
                        // } else {
                            
                       $this->room_m->updateRoom($dataUpdate, $maphong);
                           sleep(2);
                        
                            // $rooms = new room_management();
                            
                            // return view('admin.room_management.room_index',compact('rooms')); // lỗi 
                            $room = new room_management();
                            // $rooms = $room -> getAllRoom();
                            $roomAll = $room -> getRoom();
                            $room_type = $room -> getRoomType();
                            $buildings = $room ->getBuilding();
                            $gender = $room -> getGender();
                            $rooms = room_management::paginate(5); // Sử dụng paginate() để lấy dữ liệu phân trang

                            // dùng withInput để giữu lại các tham số khi chuyển hướng
                            return redirect()->route('room_management')->withInput()->with([
                                'rooms' => $rooms,
                                'buildings' => $buildings,
                                'gender' => $gender,
                                'room_type' => $room_type,
                                'roomAll' => $roomAll
                            ]);
                            //return view('admin.room_management.room_index', compact('rooms','buildings','gender','room_type','roomAll'));
                     }
   
                     

            public function delete_room(Request $rq, $maphong){
                $this->csvc_r->deleteCSVCRoom($maphong);
                $this->form->setNullRoom($maphong);
                $this->form->deleteRoom($maphong);
                $this->bill->setNullHD($maphong);
                $this -> room_m-> deleteRoom($maphong);
                sleep(2);
                return back() ;
                
            }
        }
            //         
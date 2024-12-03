<?php

namespace App\Http\Controllers\admin\area_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\area_management;
use Illuminate\Validation\ValidationException;


class AreaManagementController extends Controller
{
    public $area;
    public function __construct(){
        $this->area = new area_management();
    }

    //thêm khu
    public function add_area(){
        return view('admin.area_management.add_area');
    }
    
    public function save_area(Request $rq){
        //  return Redirect('/area_management');
        $data = [
            $rq->makhu,
           $rq->tenkhu,
      
        ];

        $exitstingArea = $this->area::where('ma_khu',$rq -> makhu) -> first();
        
            if ($exitstingArea) {
                return redirect()->route('area_management.add_area')->with('error', 'Mã khu đã tồn tại, vui lòng nhập mã khu khác !');
            } 
            else{
                $this->area->addArea($data);
                sleep(2.5);
                return redirect()->route('area_management.add_area');
            }    
         }
        

        //sửa khu
        public function form_edit_area(Request $request){
            $makhu = $request -> route('makhu');

            $hienmakhu = area_management::where('ma_khu',$makhu) ->first();
            // dd($tenkhu);
            // dd($hienmakhu);
            if ($hienmakhu) {
                $tenkhu = $hienmakhu -> ten_khu;
                // return view("admin.area_management.form_edit_area", compact('makhu', 'hienmakhu'));
               return view("admin.area_management.form_edit_area", compact('makhu', 'hienmakhu','tenkhu'));
            } else {
                return back()->with('error', 'Không có mã khu để sửa');
            }

        }
        // sửa khu
        public function update_area(Request $rq){
                $makhu = $rq -> input('makhu');
                 $dataUpdate = [
                       //'ma_khu' => $rq -> input('makhu'),
                        'ten_khu' =>  $rq -> input('tenkhu'),
                    ];
                if (!empty($rq -> input('tenkhu'))) {
                    // return view("admin.area_management.form_edit_area", compact('makhu', 'hienmakhu'));
                    $exitstingArea = $this->area::where('ten_khu', $rq -> input('tenkhu')) -> first();
                    if ($exitstingArea) {
                          return back() -> with('error', 'Tên khu đã tồn tại, vui lòng nhập tên khác !');
                    } else {
                        $this->area->updateArea($dataUpdate, $makhu);
                        sleep(2.5);
                        $area = new area_management();
                        $area = $area -> getAllArea();
                        return view('admin.area_management.area_index',compact('area'));
                    }
                } else {
                    return back()->with('error', 'Tên khu rỗng');
                }
            
        }
        
        public function delete_area(Request $rq,$makhu){
            $a =$this ->area->setNullBuilding($makhu);
          
            if($a == null){

                $this -> area -> deleteArea($makhu);
                sleep(2);
                return back();
            }
            
            }

        
}

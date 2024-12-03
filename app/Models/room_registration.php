<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Psr7\Request;

class room_registration extends Model
{
    use HasFactory;
    
    public function getAllRoom($findData =[]){
        $rooms = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        // ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->join('buildings as d','d.ma_day','=','rm.ma_day')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rt.ten_loai_phong','rm.ma_day','d.ma_khu', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
    
        ->orderBy('rm.ma_day');
        
        if(!empty($findData)){
            foreach ($findData as $row){
                $rooms = $rooms->where($row[0], $row[1]);
            }
        }
        
         return $rooms -> get();
    }

    public function getRoom(){
        $rooms = DB::table('room_management') ->select('ma_phong') ->get(); // kh có get sẽ kh thực thi , chỉ là mới trra về 1 câu truy vấn
        return $rooms;
    }

    public function getNameRoom($maphong){
        $nameroom = DB::table('room_management')
        ->where('ma_phong',$maphong)
        ->pluck('ten_phong') 
        ->first();

        return $nameroom;
    }


    public function getRoomType(){
        $rooms = DB::table('room_type') ->select('ma_loai_phong') ->get(); // kh có get sẽ kh thực thi , chỉ là mới trra về 1 câu truy vấn
        return $rooms;
    }

    public function getNameRoomType(){
        $rooms = DB::table('room_type') ->select('ten_loai_phong')
        ->distinct()
         ->get(); // kh có get sẽ kh thực thi , chỉ là mới trra về 1 câu truy vấn
         return $rooms;
    }

    public function getBuilding(){
        $buildings = DB::table('buildings') -> select('ma_day') ->get();
        return $buildings;
    }

    public function getNamBuilding($maphong){
        $buildings = DB::table('buildings as b')
                            ->join('room_management as r', 'b.ma_day', '=' ,'r.ma_day')
                            ->where('ma_phong',$maphong)
                            ->pluck('b.ten_day')
                            ->first();
                            
        return $buildings;
    }
    
    public function getNameArea($maphong){
        $area= DB::table('buildings as b')
                            ->join('room_management as r', 'b.ma_day', '=' ,'r.ma_day')
                            ->join('area_management as a', 'a.ma_khu', '=' ,'b.ma_khu')
                            ->where('ma_phong',$maphong)
                            ->pluck('a.ten_khu')
                            ->first();
        return $area;
    }
    
    public function getNameRoomType_id($maphong){
        $roomtype = DB::table('room_type as rt')
                            ->join('room_management as r', 'rt.ma_loai_phong', '=' ,'r.ma_loai')
                            ->where('ma_phong',$maphong)
                            ->pluck('rt.ten_loai_phong')
                            ->first();
                            // dd($roomtype);
        return $roomtype;
    }
    
    public function getGender(){
        $gender = DB::table('room_management') -> select('phong_nam_nu') 
        ->distinct()
        ->get();
        return $gender;
    }
    
    public function getGender_id($maphong){
        $gender = DB::table('room_management') 
                        ->where('ma_phong',$maphong)
                        ->pluck('phong_nam_nu')
                        ->first();
                     
        return $gender;
    }

    public function getPriceRoom($maphong){
        $price = DB::table('room_management as r') 
                        ->join('room_type as rt','rt.ma_loai_phong','=','r.ma_loai')
                        ->where('ma_phong',$maphong)
                        ->pluck('rt.don_gia')
                        ->first();
                $formattedPrice = number_format($price, 0, ',', '.') . ' VND';
        return $formattedPrice;
    }

     public function getStatus(){
        $status = DB::table('room_management') -> select('trang_thai') 
        ->distinct()
        ->get();
        return $status;
    }

     public function getSttRoom($maphong){
        $status = DB::table('room_management') 
                    ->where('ma_phong',$maphong)
                    -> value('trang_thai') ;
        
        return $status;
    }

    public function getBuildingSv(){
        $buildings = DB::table('buildings') 
        -> select('ten_day') 
        ->whereNotNull('ma_khu')
        ->distinct()
        ->get();
        return $buildings;
    }

  public function getSLRoom($maphong){
    $result = DB::table('room_management')
                ->where('ma_phong',$maphong)
                // ->where('trang_thai','Đang sử dụng')
                ->value('con_trong');
    return $result;
  }
    
    public function getAllRoomsStudent($perPage=null){
        $rooms = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        //->select('rm.ma_phong', 'rm.ten_phong', 'rt.ten_loai_phong', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->join('buildings as d','d.ma_day','=','rm.ma_day')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rt.ten_loai_phong','rm.ma_day','d.ma_khu', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
    
        ->orderBy('rm.ma_day');
        // ->get();

        if(!empty($perPage)){
            $rooms = $rooms ->paginate($perPage);// perPage bản ghi trên 1 trang
        }else{
            $rooms = $rooms -> get();
        }
        return $rooms ;
    }
    

    
    public function getAllRoomStudent($findData =[],$perPage =null){
       
        $rooms = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        //->select('rm.ma_phong', 'rm.ten_phong', 'rt.ten_loai_phong', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->join('buildings as d','d.ma_day','=','rm.ma_day')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rt.ten_loai_phong','rm.ma_day','d.ma_khu', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
    
        ->orderBy('rm.ma_day');
        
    //     
    if(!empty($findData)){
        foreach ($findData as $row){
            if ($row[1] === '>') {
                $rooms = $rooms->where($row[0], '>', $row[2]);
            }
            else

                $rooms = $rooms->where($row[0], $row[1]);
            }
            $rooms = $rooms ->paginate($perPage);
        }
    
     return $rooms ;
}

    public function getAllKhuUsing(){
        $rs = DB::table('room_management as r')
            ->join('buildings as d','d.ma_day','=','r.ma_day')
            // ->join('area_management as a','a.ma_khu','=','d.ma_khu')
            ->whereNotNull('d.ma_khu')
            ->select('d.ma_khu')
            ->distinct()
            ->get();
        return $rs;

    }

  
    
}

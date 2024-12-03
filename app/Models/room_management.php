<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class room_management extends Model
{
    use HasFactory;
   
    protected $table = 'room_management';
    public $timestamps = false;
    protected $fillable = [
        'ma_phong',
        'ten_phong',
        'ma_loai',
        'ma_day',
        'phong_nam_nu',
        'trang_thai',
        'so_cho',
        'da_o',
        'con_trong',
    ];

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
    public function getAllKhuNoUse(){
        
        $rs =  DB::table('room_type as rt')
                ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
                //->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
                ->join('buildings as d','d.ma_day','=','rm.ma_day')
                // ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rt.ten_loai_phong','rm.ma_day','d.ma_khu', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
                ->whereNull('d.ma_khu')
                ->select('d.ma_khu')
                ->distinct()
                // ->first();
                // ->pluck('d.ma_khu');
                ->value('d.ma_khu');
                // ->get();
                // dd($rs);
        return $rs;

    }
   // protected $table = 'room_management';
    public function getAllRoom($findData =[],$perPage =null){
       
        $rooms = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        //->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->join('buildings as d','d.ma_day','=','rm.ma_day')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rt.ten_loai_phong','rm.ma_day','d.ma_khu', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
    
        ->orderBy('rm.ma_day');
        
        if(!empty($findData)){
            foreach ($findData as $row){
                $rooms = $rooms->where($row[0], $row[1]);
            }
            $rooms = $rooms ->paginate($perPage);
        }
         return $rooms ;
    }

  
    
    public function getAllRooms($perPage=null){
        $rooms = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        ->join('buildings as d','d.ma_day','=','rm.ma_day')
        // ->join('area_management as a','d.ma_khu','=','a.ma_khu')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rt.ten_loai_phong','rm.ma_day','d.ma_khu', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        // ->whereNotNull('d.ma_khu')

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
        ->select('rm.ma_phong', 'rm.ten_phong', 'rt.ten_loai_phong', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->orderBy('rm.ma_day');
        
        if(!empty($findData)){
            foreach ($findData as $row){
                $rooms = $rooms->where($row[0], $row[1]);
            }
            $rooms = $rooms ->paginate($perPage);
        }
         return $rooms ;
    }
    public function getAllRoomsStudent($perPage=null){
        $rooms = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rt.ten_loai_phong', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->orderBy('rm.ma_day');
        // ->get();

        if(!empty($perPage)){
            $rooms = $rooms ->paginate($perPage);// perPage bản ghi trên 1 trang
        }else{
            $rooms = $rooms -> get();
        }
        return $rooms ;
    }

    public function getRoomUpdate($perPage=null){
        $rooms = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rt.ten_loai_phong', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->orderBy('rm.ma_day')
        ->get();
        return $rooms;
    }

    public function getRoom(){
        $rooms = DB::table('room_management') ->select('ma_phong') ->get(); // kh có get sẽ kh thực thi , chỉ là mới trra về 1 câu truy vấn
        return $rooms;
    }
    public function getRoomName(){
       return  $rooms = DB::table('room_management') 
                                ->select('ten_phong') 
                                ->distinct()
                                ->get(); // kh có get sẽ kh thực thi , chỉ là mới trra về 1 câu truy vấn

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
    public function getHideIDRoomType(){
        $rooms = DB::table('room_type') 
        ->select('ma_loai_phong','ten_loai_phong')
        ->distinct('ten_loai_phong')
         ->get(); // kh có get sẽ kh thực thi , chỉ là mới trra về 1 câu truy vấn
         return $rooms;
    }

    public function getBuilding(){
        $buildings = DB::table('buildings') 
        -> select('ma_day') 
        ->whereNotNull('ma_khu')
        ->distinct()
        ->get();
        return $buildings;
    }
    public function getBuildingSv(){
        $buildings = DB::table('buildings') 
        -> select('ten_day') 
        ->distinct()
        ->get();
        return $buildings;
    }
    public function getHideIDBui(){
        $buildings = DB::table('buildings') 
                ->whereNull('ma_khu')
                ->select('ma_day','ten_day')
                ->get();
            return $buildings;
    }
    public function getGender(){
        $gender = DB::table('room_management') -> select('phong_nam_nu') 
        ->distinct()
        ->get();
        return $gender;
    }

    public function getStatus(){
        $status = DB::table('room_management') -> select('trang_thai') 
        ->distinct()
        ->get();
        return $status;
    }

    public function getNumberSeats(){
        $status = DB::table('room_management') -> select('so_cho') 
        ->distinct()
        ->get();
        return $status;
    }
    public function getCurrentRoom(){
        $status = DB::table('room_management') -> select('so_cho') 
        ->distinct()
        ->get();
        return $status;
    }
    public function findIDRoom($tp,$md){
        $kq = DB::table('room_management') 
                ->where('ten_phong',$tp)
                ->where('ma_day',$md)
                ->value('ma_phong');
                // ->first();
            return $kq;

    }
    // public function getEmpty(){
    //     $emp = DB::table('room_management') 
    //     -> select('con_trong') 
    //     ->where('con_trong','>',0)
    //     // ->whereRaw('con_trong > 0') 
    //     ->distinct()
    //     ->get();
    //     return $emp;
    // }

    public function addRoom( $data){
        //DB::insert('INSERT INTO room_management(ma_phong,ten_phong,ma_loai,ma_day,phong_nam_nu,trang_thai,so_cho,da_o,con_trong) VALUES(?,?,?,?,?,?,?,?,?)',$data);
        return room_management::create([
            'ma_phong' => $data['maphong'],
            'ten_phong' => $data['tenphong'],
            'ma_loai' => $data['maloaiphong'],
            'ma_day' => $data['maday'],
            'phong_nam_nu' => $data['phongnam_nu'],
            'trang_thai' => $data['trangthai'],
            'so_cho' => $data['socho_tt'],
            'da_o' => $data['da_o'],
            'con_trong' => $data['controng']
        ]);
   }

    public function updateRoom($data, $maphong){


    $results = DB::table('room_type as rt')
        ->join('room_management as rm', 'rt.ma_loai_phong', '=', 'rm.ma_loai')
        ->select('rm.ma_phong', 'rm.ten_phong', 'rm.ma_loai', 'rm.ma_day', 'rm.phong_nam_nu', 'rt.don_gia', 'rt.suc_chua', 'rm.so_cho', 'rm.da_o', 'rm.con_trong', 'rm.trang_thai')
        ->where('ma_phong', $maphong)
        ->first();

  
        return DB::table('room_management')
            ->where('ma_phong', $maphong)
            ->update($data);

    }

    public function deleteRoom($maphong){
        $result =  DB::table('room_management')
                         -> where('ma_phong',$maphong) 
                         -> first();
        //DB la facade đại diện cho 1 lớp , nó truy vấn csdl bằng query builder
        if($result){
            DB::table('room_management') -> where('ma_phong',$maphong) -> delete();
        }
    }

    public function getSLRoom($maphong){
        $sl = DB::table('room_management') 
                -> where('ma_phong',$maphong) 
                ->value('da_o');
        return $sl;
    }
    public function getSLRoom1($maphong){
        $sl = DB::table('room_management') 
                -> where('ma_phong',$maphong) 
                ->value('con_trong');
        return $sl;
    }

    public function  updateSLRoom($maphong,$sl){
        $sl = DB::table('room_management') 
                -> where('ma_phong',$maphong) 
                ->update($sl);
      
    }
}

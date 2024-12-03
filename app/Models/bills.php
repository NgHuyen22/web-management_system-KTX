<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class bills extends Model
{
    use HasFactory;

    public function addBillRoom($dataHD){
        $rs = DB::insert('INSERT INTO bills(ten_hd,ma_phong,trang_thai,ngaydongphi,mssv) VALUES(?,?,?,now(),?)',$dataHD);
        // $rs = DB::insert('INSERT INTO bills(ten_hd,noi_dung,ngaydongphi) VALUES(?,?,now())',$dataHD);
                
    }

    public function getContentValue($ten_hd,$mssv){
        $rs = DB::table('bills')
            ->where('trang_thai',1)
            ->where('ten_hd',$ten_hd)
            ->where('mssv',$mssv)
            // ->where(explode())
            ->orderBy('id')
           ->first();
          
            // ->get();
            return $rs;
    }

    public function getAll(){
        $rs = DB::table('bills as b')
            ->join('room_management as rm','b.ma_phong','=','rm.ma_phong')
            ->join('room_type as rt','rt.ma_loai_phong','=','rm.ma_loai')
            ->select('b.*','rt.don_gia')
            ->get();
        return $rs;
    }
    public function getAllNotNull(){
        $rs = DB::table('bills')
            ->get();
        return $rs;
    }

    public function setNullHD($maphong){
        $rs = DB::table('bills')
                ->where('ma_phong',$maphong)
                ->update(['ma_phong' => null]);
    }
    public function setNullHD_SV($mssv){
        $rs = DB::table('bills')
                ->where('mssv',$mssv)
                ->update(['mssv' => null]);
    }

}

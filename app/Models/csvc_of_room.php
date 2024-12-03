<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class csvc_of_room extends Model
{
    use HasFactory;

    public function getCSVCRoom($maphong){
        $csvc = DB::table('csvc_of_room as a')
                    ->where('ma_phong',$maphong)
                    ->join('csvc as c','c.ma_csvc','=','a.ma_csvc')
                    ->select('c.ten_csvc','c.ma_csvc')
                    ->get();
        return $csvc;
    }

    // public function getallCsvc_RoomList(){
    //     $rs = DB::table('csvc_of_room as a')
    //             ->join('csvc as c','c.ma_csvc','=','a.ma_csvc')
    //             ->join('room_management as r','r.ma_phong','=','a.ma_phong')
    //             ->select('a.*','c.ten_csvc','r.*')
    //         ->get();
    //     return $rs;
    // }
    public function getallCsvc_RoomList(){
        $rs = DB::table('csvc_of_room as a')
                ->join('csvc as c','c.ma_csvc','=','a.ma_csvc')
                ->join('room_management as r','r.ma_phong','=','a.ma_phong')
                ->select('a.*','c.ten_csvc','r.*')
            ->get();
        return $rs;
    }
    
    public function deleteCSVCRoom($maphong){
        $rs = DB::table('csvc_of_room')
                ->where('ma_phong',$maphong)
                ->delete();
    }
    public function deleteCSVC_Room($ma_csvc){
        $rs = DB::table('csvc_of_room')
                ->where('ma_csvc',$ma_csvc)
                ->delete();
    }

    public function add($data){
        $success =DB::insert('INSERT INTO csvc_of_room(ma_csvc, ma_phong, so_luong) VALUES(?,?,?)',$data);
        // $success = DB::insert('INSERT INTO csvc_of_room(ma_csvc, ma_phong, so_luong) VALUES(:ma_csvc, :ma_phong, :so_luong)', $data);
        return $success;
        
    }

    
}

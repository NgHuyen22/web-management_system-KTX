<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class csvc_repair_details extends Model
{
    use HasFactory;

    public function addForm($dataRepairCSVC){
        $success =DB::insert('INSERT INTO csvc_repair_details(ma_csvc,ma_don,so_luong,tinh_trang,vi_tri_sua) VALUES(?,?,?,?,?)',$dataRepairCSVC);
        return $success;
    }

    public function cancleFormRepair($ma_sua){
        $delete = DB::table('csvc_repair_details')
                    ->where('ma_sua_csvc',$ma_sua)
                    ->delete();
    }
     
    public function getAllIDFormRepair(){
        $all = $id = DB::table('form as f')
                    ->join('csvc_repair_details as cs','cs.ma_don','=','f.id')
                    ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
                    ->join('csvc as c','c.ma_csvc','=','cs.ma_csvc')
                    ->join('student as st','st.mssv','=','f.mssv')
                    ->join('school_year as y','y.id','=','f.stt_hk_nh')
                    ->where('f.ma_loai','LD004')
                    ->whereNull('f.trang_thai')
                    ->select('f.*','y.hoc_ky','y.nam_hoc','ft.ten_loai','c.ten_csvc','cs.ma_sua_csvc','cs.so_luong','cs.tinh_trang','cs.vi_tri_sua','st.ho_tenSV')
                    ->get();
        return $all;
    }
    public function getAllIDFormRepairNull(){
        $all  = DB::table('form as f')
                    ->join('csvc_repair_details as cs','cs.ma_don','=','f.id')
                    ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
                    // ->join('csvc as c','c.ma_csvc','=','cs.ma_csvc')
                    ->join('student as st','st.mssv','=','f.mssv')
                    ->join('school_year as y','y.id','=','f.stt_hk_nh')
                    ->where('f.ma_loai','LD004')
                    ->whereNull('f.trang_thai')            
                    ->select('f.*','y.hoc_ky','y.nam_hoc','ft.ten_loai','cs.ma_csvc','cs.ma_sua_csvc','cs.so_luong','cs.tinh_trang','cs.vi_tri_sua','st.ho_tenSV')
                    ->get();
                    // dd($all);
        return $all;
    }

    public function getApprovedAllIDFormRepair(){
        $all = $id = DB::table('form as f')
                    ->join('csvc_repair_details as cs','cs.ma_don','=','f.id')
                    ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
                    ->join('csvc as c','c.ma_csvc','=','cs.ma_csvc')
                    ->join('student as st','st.mssv','=','f.mssv')
                    ->join('school_year as y','y.id','=','f.stt_hk_nh')
                    ->where('f.ma_loai','LD004')
                    ->where('f.trang_thai',1)         
                    ->whereNull('cs.ma_csvc')         
                    // ->where('f.',1)         
                    ->select('f.*','y.hoc_ky','y.nam_hoc','ft.ten_loai','c.ten_csvc','cs.ma_sua_csvc','cs.so_luong','cs.tinh_trang','cs.vi_tri_sua','st.ho_tenSV')
                    ->get();
                    // ->first();
                    // dd($all);
        
        return $all;
    }
    public function getApprovedAllIDFormRepairNull(){
        $all = $id = DB::table('form as f')
                    ->join('csvc_repair_details as cs','cs.ma_don','=','f.id')
                    ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
                    // ->join('csvc as c','c.ma_csvc','=','cs.ma_csvc')
                    ->join('student as st','st.mssv','=','f.mssv')
                    ->join('school_year as y','y.id','=','f.stt_hk_nh')
                    ->where('f.ma_loai','LD004')
                    ->where('f.trang_thai',1)               
                    ->select('f.*','y.hoc_ky','y.nam_hoc','ft.ten_loai','cs.ma_csvc','cs.ma_sua_csvc','cs.so_luong','cs.tinh_trang','cs.vi_tri_sua','st.ho_tenSV')
                    ->get();
       
        return $all;
    }

    public function SetNull($dataNull,$ma_csvc){
        $setnull = DB::table('csvc_repair_details')
                    ->where('ma_csvc',$ma_csvc)
                    ->update($dataNull);
    }
    public function deleteForm($madon){
        $setnull = DB::table('csvc_repair_details')
                    ->where('ma_don',$madon)
                    ->delete();
    }
}

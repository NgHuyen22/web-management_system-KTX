<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class form extends Model
{
    use HasFactory;

    public function getCodeTypeRoom($maphong){
        $codetype = DB::table('room_type as rt') 
                            ->join('room_management as r','rt.ma_loai_phong','=','r.ma_loai')
                            ->where('ma_phong',$maphong)
                            ->pluck('rt.ma_loai_phong')
                            ->first();
                        //    dd($codetype);
        return $codetype;
    }

    public function getTypeForm(){
            $typeroom = DB::table('form_type')
                                ->where('ma_loai','LD001')
                                ->value('ma_loai');
                               
            return $typeroom;
    }
    public function countForm($mssv,$maloai){
        $typeroom = DB::table('form')
                        ->where('ma_loai',$maloai)
                        ->where('mssv',$mssv)
                        ->count('id');
       
        return $typeroom;
    }
    
    public function getSchoolYear(){
        $nh = DB::table('school_year') 
                            ->where('nam_hoc', DB::table('school_year')->max('nam_hoc'))
                            ->value('nam_hoc');
                           
                        
        return $nh;
    }

    public function getStt_Hk_Nh($hk,$nh){
        $hk_nh = DB::table('school_year') 
                            ->where('hoc_ky',$hk)
                            ->where('nam_hoc',$nh)
                            ->pluck('id')
                            ->first();
                  
        return $hk_nh;
    }


    public function getRoomRegistration(){
        $loai_don = DB::table('form_type')
                            ->where('ma_loai','LD001')
                            ->value('ma_loai');
                         
        return $loai_don;

    }

    public function getChangeRoom(){
        $loai_don = DB::table('form_type')
                            ->where('ma_loai','LD002')
                            ->value('ma_loai');
                         
        return $loai_don;

    }



    public function getTypeGiveBackRoom(){
        $loai_don = DB::table('form_type')
                            ->where('ma_loai','LD003')
                            ->value('ma_loai');
                         
        return $loai_don;

    }

    public function getIDForm($mssv,$maphong){
        $id = DB::table('form as f')
                ->where('f.mssv',$mssv)
                ->where('f.ma_phong',$maphong)
                ->orderBy('f.id', 'desc') // Sắp xếp theo id giảm dần
                ->first();
          
        return $id;

    }

    public function  getIDFormRepair($mssv,$loai_don){
        $id = DB::table('form')
            ->where('mssv',$mssv)
            ->where('ma_loai',$loai_don)
            ->orderBy('id','desc')
           
            ->first();
        return $id;
    }

    public function  getAllIDFormRepair($mssv,$loai_don){
        $id = DB::table('form as f')
            ->join('csvc_repair_details as cs','cs.ma_don','=','f.id')
            ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
            ->join('csvc as c','c.ma_csvc','=','cs.ma_csvc')
            ->join('student as st','st.mssv','=','f.mssv')
            ->where('f.mssv',$mssv)
            ->where('f.ma_loai',$loai_don)
            ->select('f.*','ft.ten_loai','c.ten_csvc','cs.ma_sua_csvc','cs.so_luong','cs.tinh_trang','cs.vi_tri_sua','st.ho_tenSV')
            ->get();
        return $id;
    }
    public function getFormRepairNull($mssv,$loai_don){
        $id = DB::table('form as f')
                ->join('csvc_repair_details as cs','cs.ma_don','=','f.id')
                ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
                ->join('student as st','st.mssv','=','f.mssv')
                ->where('f.mssv',$mssv)
                ->where('f.ma_loai',$loai_don)
                ->whereNull('cs.ma_csvc')
                ->where('f.trang_thai',1)
                ->select('f.*','ft.ten_loai','cs.ma_sua_csvc','cs.ma_csvc','cs.so_luong','cs.tinh_trang','cs.vi_tri_sua','st.ho_tenSV')
                ->get();
            return $id;
           
    }
    public function setNullRoom($maphong){
        $id = DB::table('form')
            ->where('ma_phong',$maphong)
            ->where('trang_thai',1)
            ->update(['ma_phong' => null]);
    }
    public function deleteRoom($maphong){
        $id = DB::table('form')
            ->where('ma_phong',$maphong)
            ->whereNull('trang_thai')
            ->delete();
    }
    public function  checkIDFormRepair($mssv,$loai_don){
        $id = DB::table('form as f')
            ->join('csvc_repair_details as cs','cs.ma_don','=','f.id')
            ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
            ->join('csvc as c','c.ma_csvc','=','cs.ma_csvc')
            ->join('student as st','st.mssv','=','f.mssv')
            ->where('f.mssv',$mssv)
            ->where('f.ma_loai',$loai_don)
            ->select('f.*','ft.ten_loai','c.ten_csvc','cs.ma_sua_csvc','cs.so_luong','cs.tinh_trang','cs.vi_tri_sua','st.ho_tenSV')
            ->first();
        return $id;
    }

    public function checkSTTForm($mssv,$loai_don){
        $dasua = DB::table('form')
                    ->where('mssv',$mssv)
                    ->where('ma_loai',$loai_don)
                    ->where('trang_thai',1)
                    ->value('id');
            return $dasua;
    }
    public function  getIDRepairDetails($ma_sua){
        $rs = DB::table('csvc_repair_details')
                ->where('ma_sua_csvc',$ma_sua)
                ->first();
        return $rs;
    }

    public function getIDFormApproved($mssv){
        $id = DB::table('form as f')
                ->where('f.mssv',$mssv)
                // ->where('f.ma_phong',$maphong)
                // ->where('f.trang_thai',1)
                // ->where('f.ma_loai','LD002')
                ->orderBy('f.id', 'desc') // Sắp xếp theo id giảm dần
                ->first();
          
        return $id;

    }

    public function addForm($data){
        $success =DB::insert('INSERT INTO form(ngay_tao,ngay_duyet,ma_loai,mssv,ma_phong,stt_hk_nh) VALUES(?,NULL,?,?,?,?)',$data);
       return $success;
    }

  

    public function approveRegister(){
        $listForm = DB::table('form as f')
                            ->join('school_year as nam','f.stt_hk_nh','=','nam.id')
                            ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
                            ->select('f.*','ft.ten_loai','nam.hoc_ky','nam.nam_hoc')
                            ->where('f.ma_loai','LD001')
                            ->whereNull('f.trang_thai')
                            ->get();
        return $listForm;
    }
    
    public function approvedRegister(){
        $listForm = DB::table('form as f')
        ->join('school_year as nam','f.stt_hk_nh','=','nam.id')
        ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
        ->select('f.*','ft.ten_loai','nam.hoc_ky','nam.nam_hoc')
        ->where('f.ma_loai','LD001')
        ->where('f.trang_thai',1)
        ->get();
        return $listForm;
    }
    
    public function unapproveChanges(){
        $listForm = DB::table('form as f')
        ->join('school_year as nam','f.stt_hk_nh','=','nam.id')
        ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
        ->select('f.*','ft.ten_loai','nam.hoc_ky','nam.nam_hoc')
        ->where('f.ma_loai','LD002')
        ->whereNull('f.trang_thai')
        ->get();
        return $listForm;
    }
    
    public function approvedChanges(){
        $listForm = DB::table('form as f')
        ->join('school_year as nam','f.stt_hk_nh','=','nam.id')
        ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
        ->select('f.*','ft.ten_loai','nam.hoc_ky','nam.nam_hoc')
        ->where('f.ma_loai','LD002')
        ->where('f.trang_thai',1)
        ->get();
        return $listForm;
    }
    
    public function unapproveGiveBack(){
        $listForm = DB::table('form as f')
        ->join('school_year as nam','f.stt_hk_nh','=','nam.id')
        ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
        ->select('f.*','ft.ten_loai','nam.hoc_ky','nam.nam_hoc')
        ->where('f.ma_loai','LD003')
        ->whereNull('f.trang_thai')
        ->get();
        return $listForm;
    }
    
    public function approvedGiveBack(){
        $listForm = DB::table('form as f')
        ->join('school_year as nam','f.stt_hk_nh','=','nam.id')
        ->join('form_type as ft','ft.ma_loai','=','f.ma_loai')
        ->select('f.*','ft.ten_loai','nam.hoc_ky','nam.nam_hoc')
        ->where('f.ma_loai','LD003')
        ->where('f.trang_thai',1)
        ->get();
        return $listForm;
    }

    public function countAllForm(){
        $count = DB::table('form')
                    ->count('id');
            return $count;
    }

    public function countUnapprovedForm(){
        $count = DB::table('form')
                    ->whereNull('trang_thai')
                    ->count('id');
        return $count;
    }

    public function countApprovedForm(){
        $count = DB::table('form')
                    ->where('trang_thai',1)
                    ->count('id');
                    return $count;
    }
    //dki_phong
    public function countAllRoomRegistration(){
        $count = DB::table('form')
                        ->where('ma_loai','LD001')
                        ->count('id');
                return $count;
    }
    
    public function countUnapproveRoomRegistration(){
        $count = DB::table('form')
        ->where('ma_loai','LD001')
        ->whereNull('trang_thai')
        ->count('id');
        return $count;
    }
    public function countApproveRoomRegistration(){
        $count = DB::table('form')
        ->where('ma_loai','LD001')
        ->where('trang_thai',1)
        ->count('id');
        return $count;
    }
    
    //chuyen_phong
    public function countAllChangeRoom(){
        $count = DB::table('form')
        ->where('ma_loai','LD002')
        ->count('id');
        return $count;
    }
    
    public function countUnapproveChangeRoom(){
        $count = DB::table('form')
        ->where('ma_loai','LD002')
        ->whereNull('trang_thai')
        ->count('id');
        return $count;
    }
    public function countApproveChangeRoom(){
        $count = DB::table('form')
        ->where('ma_loai','LD002')
        ->where('trang_thai',1)
        ->count('id');
        return $count;
    }
    //tra_phong
    public function countAllGiveBackRoom(){
        $count = DB::table('form')
        ->where('ma_loai','LD003')
        ->count('id');
        return $count;
    }
    
    public function countUnapproveGiveBackRoom(){
        $count = DB::table('form')
        ->where('ma_loai','LD003')
        ->whereNull('trang_thai')
        ->count('id');
        return $count;
    }
    
    public function countApproveGiveBackRoom(){
        $count = DB::table('form')
        ->where('ma_loai','LD003')
        ->where('trang_thai',1)
        ->count('id');
        return $count;
    }
    //sua_chua_csvc
    public function countAllCsvcRepairForm(){
        $count = DB::table('form')
        ->where('ma_loai','LD004')
        ->count('id');
        return $count;
    }
    public function countUnapproveCsvcRepaiForm(){
        $count = DB::table('form')
        ->where('ma_loai','LD004')
        ->whereNull('trang_thai')
        ->count('id');
        return $count;
    }
    public function countApproveCsvcRepaiForm(){
        $count = DB::table('form')
        ->where('ma_loai','LD004')
        ->where('trang_thai',1)
        ->count('id');
        return $count;
    }

    public function updateSTTNotAcp($data,$id_form){
        $acpForm = DB::table('form as f')
                        ->where('f.id',$id_form)
                        // ->first()                  
                        ->update($data);      
    }
    // public function updateSTTNotAcp($data,$id_form){
    //     $acpForm = DB::table('form as f')
    //                     ->where('f.id','=',$id_form)               
    //                     ->update($data);      
    // }

    public function deleteForm($mssv){
        $acpForm = DB::table('form')
                        ->where('mssv', $mssv)            
                        ->where('trang_thai', 1) 
                        ->delete();
    }

    public function getIDForm_Mssv($mssv){
        $id_form =  DB::table('form as f')
                        -> where('f.mssv',$mssv)
                        // ->where('f.ma_loai','LD001')
                        ->orderBy('f.id')
                        ->value('f.id');
        return $id_form;
    }

    public function getIDForm_MssvUn($mssv){
        $id_form =  DB::table('form as f')
                        ->join('room_management as rm','rm.ma_phong','=','f.ma_phong')
                        ->join('room_type as rt','rt.ma_loai_phong','=','rm.ma_loai')
                        -> where('f.mssv',$mssv)
                        // ->where('f.ma_loai','LD001')
                        // ->whereNull('f.trang_thai')
                        ->select('f.*','rm.ten_phong','rm.ma_day','rt.don_gia')
                        ->orderBy('f.id')
                        ->first();
                        // ->value('id');
                      
        return $id_form;
    }

    public function getIDForm_not_approved_register($mssv){
        $id_form =  DB::table('form as f')
                        -> where('f.mssv',$mssv)
                        ->where('f.ma_loai','LD001')
                        ->whereNull('f.trang_thai')
                        ->value('f.id');
        return $id_form;
    }

    public function getIDForm_approved_register($mssv){
        $id_form =  DB::table('form as f')
                        -> where('f.mssv',$mssv)
                        ->where('f.ma_loai','LD001')
                        ->where('f.trang_thai',1)
                        ->value('f.id');
        return $id_form;
    }

    public function getIDFormUnapproveChanges($mssv){
            $id_form =  DB::table('form as f')
                        -> where('f.mssv',$mssv)
                        ->where('f.ma_loai','LD002')
                        ->whereNull('f.trang_thai')
                        ->value('f.id');
            return $id_form;
    }

    public function cancleForm($mssv){
        $deletedForms = DB::table('form')
                            ->where('mssv', $mssv)
                            ->where('ma_loai', 'LD001')
                            ->whereNull('trang_thai')
                            ->delete();
    }

    public function cancleFormChanges($mssv){
        $deletedForms = DB::table('form')
                            ->where('mssv', $mssv)
                            ->where('ma_loai', 'LD002')
                            ->whereNull('trang_thai')
                            ->delete();
    }

    public function cancleFormGiveBack($mssv){
        $deletedForms = DB::table('form')
                            ->where('mssv', $mssv)
                            ->where('ma_loai', 'LD003')
                            ->whereNull('trang_thai')
                            ->delete();
    }

    public function getRoomCode($id_form){
        $maphong = DB::table('form')
                            ->where('id',$id_form)
                            ->value('ma_phong');
        return $maphong;
    }

    public function deleteFormRepair($madon){
        $delete =DB::table('form')
                    ->where('id',$madon)
                    ->delete();

    }

    public function getMaDonRepair($mssv,$loai){
            $rs = DB::table('form')
                    ->where('mssv',$mssv)
                    ->where('ma_loai',$loai)
                    // ->select('id')
                    ->get();
            return $rs;
           dd($rs);
    }

}

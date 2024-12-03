<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'mssv',
        'ho_tenSV',
        'email',
        'password',
        'nganh_hoc',
        'ngay_sinh',
        'gioi_tinh',
        'sv_ktx',
    ];

    
    
    public function addsv($data) {
        return DB::table('student')->insert([
            'mssv' => $data['mssv'],
            'ho_tenSV' => $data['ho_tenSV'],
            'email' => $data['email'],
            'password' => md5($data['password']),
            'nganh_hoc' => $data['nganh_hoc'],
            'ngay_sinh' => date('Y-m-d', strtotime($data['ngay_sinh'])),
            'gioi_tinh' => $data['gioi_tinh'],
            'sv_ktx' => $data['sv_ktx'],
        ]);
    }

    public function getUserSv($mssv, $pass)
    {
        $info = DB::table('student')
            ->select('*')
            ->where('mssv', $mssv)
            ->where('password', $pass)
            ->first();
    
        return $info;
    }

    public function getHotenSv($mscb)
    {
        $info = DB::table('student')
      
            ->where('mssv', $mscb)
            ->pluck('ho_tenSV') 
            ->first();
    
        return $info;
    }

    public function getProfileSV($mssv){
        $info = DB::table('student')
            ->select('*')
            ->where('mssv', $mssv)
            // ->pluck('hoten') //lay hoten đó ra luôn thay vì có tên cột hoten nửa
            ->first();
    
        return $info;
    }

    public function getProfileAllSV($perpage){
        $info = DB::table('student as st')
                    ->join('form as f', function($join) {
                        $join->on('f.mssv', '=', 'st.mssv')
                            ->whereRaw('f.id = (SELECT MAX(id) FROM form WHERE mssv = st.mssv)');
                    })
                    ->select('st.*', 'f.ma_phong')
                    ->where('st.sv_ktx', 1)
                    ->paginate($perpage);
                    // ->get();
                    
        return $info ;
    }

    public function getAllStudents(){
        $all = DB::table('student')
                ->where('sv_ktx',1)
                ->count();
        return $all;
    }

    public function getFormMssv($mssv,$maloai){
        $form = DB::table('form as f')
                       /* ->join('form_type as ft','f.ma_loai','=','ft.ma_loai','AND', 'school_year as nam','f.stt_hk_nh ','=','nam.id')
                        ->where('f.msvv',$mssv,'AND','f.maloai',$maloai)*/
                        ->join('form_type as ft', 'f.ma_loai', '=', 'ft.ma_loai')
                        ->join('school_year as nam', 'f.stt_hk_nh', '=', 'nam.id')
                        ->where('f.mssv', $mssv)
                        ->where('f.ma_loai', $maloai)
                        ->orderBy('f.id', 'desc' )
                        ->select('f.ma_loai', 'ft.ten_loai', 'f.ma_phong', 'f.mssv', 'nam.hoc_ky','nam.nam_hoc','f.ngay_tao','f.ngay_duyet','f.trang_thai')
                        ->first();
                     
        return $form;
    }
    
    public function addStudentKtx($mssv,$data){
        $success = DB::table('student as st')
                        ->where('st.mssv',$mssv)
                        ->update($data);

    }

    public function deleteStudentKtx($mssv,$data){
        $success = DB::table('student as st')
                        ->where('st.mssv',$mssv)
                        ->update($data);

    }


    public function searchSV($keywords = null,$perpage =3){
        $sql = DB::table('student as st')
                ->select('*')
                ->join('form as f', function($join) {
                    $join->on('f.mssv', '=', 'st.mssv')
                        ->whereRaw('f.id = (SELECT MAX(id) FROM form WHERE mssv = st.mssv)');
                })
                ->select('st.*', 'f.ma_phong')
                ->where('st.sv_ktx', 1);
            if(!empty($keywords)){
                $sql= $sql-> where(function($query) use($keywords){
                    $query ->orWhere('st.mssv','like','%' .$keywords. '%');
                    $query ->orWhere('st.ho_tensv','like','%' .$keywords. '%');
                    $query ->orWhere('st.email','like','%' .$keywords. '%');
                    $query ->orWhere('st.nganh_hoc','like','%' .$keywords. '%');
                    $query ->orWhere('st.ngay_sinh','like','%' .$keywords. '%');
                    $query ->orWhere('st.gioi_tinh','like','%' .$keywords. '%');
                    $query ->orWhere('st.gioi_tinh','like','%' .$keywords. '%');
                    $query ->orWhere('f.ma_phong','like','%' .$keywords. '%');
                });
            }
            return $sql ->paginate($perpage);
    }
}


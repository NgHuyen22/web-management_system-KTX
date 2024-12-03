<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class csvc extends Model
{
    use HasFactory;

    public function getCSVC($ma_csvc){
            $rs = DB::table('csvc')
                    ->select('ten_csvc','so_luong')
                    ->where('ma_csvc',$ma_csvc)
                    ->first();
            return $rs;
    }
    public function getAllCSVCList($keywords = null){
        $rs = DB::table('csvc')
                ->select('*');
                if(!empty($keywords)){
                    $rs= $rs-> where(function($query) use($keywords){
                        $query ->orWhere('ma_csvc','like','%' .$keywords. '%');
                        $query ->orWhere('ten_csvc','like','%' .$keywords. '%');
                        // $query ->orWhere('','like','%' .$keywords. '%');
                    });
                }
        return $rs ->get();
        // return $rs;
    }

    public function updateCsvc($dataUpdate,$ma_csvc){
        $update = DB::table('csvc')
                    ->where('ma_csvc',$ma_csvc)
                   
                    ->update($dataUpdate);
                    
    }
    public function deleteCsvc($ma_csvc){
        $delete = DB::table('csvc')
                    ->where('ma_csvc',$ma_csvc)
                    ->delete();
    }

    public function countCSVC(){
        $count = DB::table('csvc')
                    ->select('ma_csvc')
                    ->count();

        return $count;
    }

    public function getCSVCRoom(){
        $csvc = DB::table('csvc') 
                    ->select('ten_csvc','ma_csvc')
                    ->get();
        return $csvc;
    }

    public function getSLCSVC($ma_csvc){
        $csvc = DB::table('csvc') 
                ->where('ma_csvc',$ma_csvc)
                ->value('so_luong');
        return $csvc;
    }

    public function UpdateSL($sl_tong,$ma_csvc){
        $rs = DB::table('csvc')
                ->where('ma_csvc',$ma_csvc)
                ->update(['so_luong' => $sl_tong]);
    }

    public function SearchKeywords($keywords =null){
        
            $search =  DB::table('csvc')
                          
                            ->select('ma_csvc','ten_csvc');
                        
            
            if(!empty($keywords)){
                $search= $search-> where(function($query) use($keywords){
                    $query ->orWhere('ma_csvc','like','%' .$keywords. '%');
                    $query ->orWhere('ten_csvc','like','%' .$keywords. '%');
                });
            }
            return $search ->get();
            
        
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class area_management extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'ma_khu',
    //     'ten_khu',
    // ];

    protected $table = 'area_management';
    public function getAllArea(){
        // $area = DB::select('SELECT * FROM area_management ORDER BY ma_khu ASC');
        $area = DB::table('area_management') ->get();
        return $area;
    }

    public function findOne($makhu) {
        $area = DB::table('area_management')->where('ma_khu', $makhu)->first();
        return $area;
    }

    // protected $table ='area_management';
    public function addArea( $data){
         DB::insert('INSERT INTO area_management(ma_khu,ten_khu) VALUES(?,?)',$data);
       
    }

    public function updateArea($data, $makhu){
        $result = DB::table($this->table)->where('ma_khu', $makhu)->first();

        if ($result) {
            DB::table($this->table)->where('ma_khu', $makhu)->update($data);
        }
    }

    // return DB::table($this -> table) -> where('ma_khu',$makhu) -> update($data);
   

    public function deleteArea($makhu){
        $result =  DB::table($this -> table) -> where('ma_khu',$makhu) -> first();

        if($result){
            DB::table($this -> table) -> where('ma_khu',$makhu) -> delete();
        }
    }
    public function setNullBuilding($makhu){
        $rs = DB::table('buildings')
             ->where('ma_khu',$makhu)
             ->update(['ma_khu' => null]);
             
    }
        public function getArea($keywords= null){
            $area = DB::table('area_management') 
            ->select('*');
            
            if(!empty($keywords)){
                $area= $area-> where(function($query) use($keywords){
                    $query ->orWhere('ma_khu','like','%' .$keywords. '%');
                    $query ->orWhere('ten_khu','like','%' .$keywords. '%');
                });
            }
            return $area ->get();
            
        }
    }

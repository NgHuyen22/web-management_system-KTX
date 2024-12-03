<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class cbql extends Model
{
    use HasFactory;

    protected $table = 'cbql';
    protected $fillable = [
        'mscb',
        'hoten',
        'gioitinh',
        'chucvu',
        'email',
        'password',
       
    ];

    public function getUser($mscb, $pass)
    {
        $info = DB::table('cbql')
            ->select('*')
            ->where('mscb', $mscb)
            ->where('password', $pass)
            ->first();
    
        return $info;
    }

    public function getHotencb($mscb)
    {
        $info = DB::table('cbql')
      
            ->where('mscb', $mscb)
            ->pluck('hoten') //lay hoten đó ra luôn thay vì có tên cột hoten nửa
            ->first();
    
        return $info;
    }
    
    public function getProfileCB($mscb){
        $info = DB::table('cbql')
            ->select('*')
            ->where('mscb', $mscb)
            // ->pluck('hoten') //lay hoten đó ra luôn thay vì có tên cột hoten nửa
            ->first();
    
        return $info;
    }

    public function addCbql($data) {
        return DB::table('cbql')->insert([
            'mscb' => $data['mscb'],
            'hoten' => $data['hoten'],
            'gioitinh' => $data['gioitinh'],
            'chucvu' => $data['chucvu'],
            'email' => $data['email'],
            'password' => md5($data['password']),
        ]);
    }
}

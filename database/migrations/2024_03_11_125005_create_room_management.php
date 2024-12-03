<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_management', function (Blueprint $table) {
            $table->string('ma_phong',10) ->primary();
            $table->string('ten_phong',10) ;
            $table->string('ma_loai',10) ;
            $table->string('ma_day',10) ;
            $table->float('don_gia') ;
            $table->string('phong_nam_nu',5);
            $table ->integer('so_cho');
            $table -> integer('da_o');
            $table -> integer('con_trong');
            $table -> string('trang_thai',50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_management');
    }
};

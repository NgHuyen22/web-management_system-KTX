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
        Schema::create('csvc_of_room', function (Blueprint $table) {
            $table->integer('ID') ->primary() ;
            $table->string('ma_csvc',10) ;
            $table->string('ma_phong',10);
            $table->integer('so_luong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csvc_of_room');
    }
};

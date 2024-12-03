<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form', function (Blueprint $table) {
            $table->id();
            $table->timestamp('ngay_tao') ->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamp('ngay_duyet') ->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->boolean('trang_thai');
            $table->string('ma_loai',10);
            $table->string('mssv',10);
            $table->string('ma_phong',10);
            $table->integer('stt_hk_nh');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form');
    }
};

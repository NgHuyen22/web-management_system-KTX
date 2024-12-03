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
        Schema::create('csvc_repair_details', function (Blueprint $table) {
            $table->id('ma_sua_csvc');
            $table->string('ma_csvc',10) ->nullable(true);
            $table->foreignId('ma_don')->constrained('form')->change() ;
            $table->integer('so_luong') -> nullable(false);
            $table->string('tinh_trang',30) -> nullable(false);
            $table->string('vi_tri_sua',20) -> nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csvc_repair_details');
    }
};

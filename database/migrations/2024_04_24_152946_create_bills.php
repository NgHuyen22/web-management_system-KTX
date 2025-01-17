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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('ten_hd',30) ->nullable(false);
            $table->string('noi_dung',35) ->nullable(true);
            $table->string('ma_phong',10) ->constrained('room_management');
            $table->boolean('trang_thai');
            $table->date('ngaycapnhat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};

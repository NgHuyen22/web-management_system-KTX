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
        Schema::create('area_management', function (Blueprint $table) {
            $table->string('ma_khu',10)->primary();
            $table->string('ten_khu',30);
            // $table ->string('mscb',10) -> nullable(false) -> foreign();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_management');
    }
};

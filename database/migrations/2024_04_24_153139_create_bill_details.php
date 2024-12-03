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
        Schema::create('bill_detials', function (Blueprint $table) {
            $table->id();
            $table->float('chi_so_dien')->nullable(false);
            $table->float('chi_so_nuoc')->nullable(false);
            $table->foreignId('ma_hd')->constant('bills');
            $table->integer('thang')->nullable(false);
            $table->float('thanh_tien')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_detials');
    }
};

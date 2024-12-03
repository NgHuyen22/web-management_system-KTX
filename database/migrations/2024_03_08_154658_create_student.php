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
        Schema::create('student', function (Blueprint $table) {
            $table -> string('mssv',10) ->primary();
            $table -> string('ho_tenSV',30);
            $table -> string('email',100);
            $table -> string('password',32);
            $table -> string('nganh_hoc',100);
            $table -> date('ngay_sinh');
            $table -> string('gioi_tinh');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};

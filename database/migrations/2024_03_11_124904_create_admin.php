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
        Schema::create('admin', function (Blueprint $table) {
            $table -> string('mscb',10) ->primary();
            $table -> string('hoten_cb',30);
            $table -> string('email',100);
            $table -> string('password',10);
            $table -> date('ngay_sinh');
            $table -> boolean('gioi_tinh');
            $table -> string('chuc_vu',100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};

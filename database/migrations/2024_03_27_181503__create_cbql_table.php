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
        Schema::create('cbql', function (Blueprint $table) {
            $table->string('mscb', 10)->primary();
            $table->string('hoten', 50)->nullable(false);
            $table->string('gioitinh', 5)->nullable(false);
            $table->string('chucvu', 50)->nullable(false);
            $table->string('email', 50)->nullable(false)->unique();
            $table->string('password', 10)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbql');
    }
};

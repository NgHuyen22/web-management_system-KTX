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
        Schema::create('csvc', function (Blueprint $table) {
            $table->string('ma_csvc',10) ->primary();
            $table->string('ten_csvc',30) ->nullable(false);
            $table->integer('so_luong') -> nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csvc');
    }
};

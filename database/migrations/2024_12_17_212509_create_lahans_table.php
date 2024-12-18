<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLahansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('lahans', function (Blueprint $table) {
            $table->id('ID_Lahan');
            $table->string('pemilik');
            $table->decimal('luas', 10, 2);
            $table->string('lokasi');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahans');
    }
};

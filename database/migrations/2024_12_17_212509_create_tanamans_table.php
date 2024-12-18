<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanamansTable extends Migration
{
    public function up()
    {
        Schema::create('tanamans', function (Blueprint $table) {
            $table->id('ID_Tanaman');
            $table->foreignId('ID_Lahan')->constrained('lahans', 'ID_Lahan')->onDelete('cascade');
            $table->string('Jenis_Tanaman');
            $table->string('Varietas');
            $table->date('Tanggal_Penanaman')->nullable();
            $table->date('Perkiraan_Panen')->nullable();
            $table->enum('Status', ['ditanam', 'tumbuh', 'panen', 'gagal'])->default('ditanam');
            $table->text('Catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanamans');
    }
}

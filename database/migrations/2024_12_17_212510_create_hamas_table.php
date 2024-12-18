<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHamasTable extends Migration
{
    public function up()
    {
        Schema::create('hamas', function (Blueprint $table) {
            $table->id('ID_Hama'); // Primary Key
            $table->foreignId('ID_Tanaman')->constrained('tanamans', 'ID_Tanaman'); // Foreign Key
            $table->string('Jenis_Hama_Virus_Penyakit'); // Jenis hama atau penyakit
            $table->text('Deskripsi'); // Deskripsi masalah
            $table->date('Tanggal_Laporan'); // Tanggal laporan
            $table->string('Foto')->nullable(); // Foto masalah (opsional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hamas');
    }
}

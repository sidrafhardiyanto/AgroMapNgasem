<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHamasTable extends Migration
{
    public function up()
    {
        Schema::create('hamas', function (Blueprint $table) {
            $table->id('ID_Hama');
            $table->foreignId('ID_Tanaman')->constrained('tanamans', 'ID_Tanaman')->onDelete('cascade');
            $table->enum('jenis', ['hama', 'virus', 'penyakit']);
            $table->string('nama');
            $table->date('tanggal_laporan');
            $table->enum('tingkat_serangan', ['ringan', 'sedang', 'berat']);
            $table->enum('status', ['proses', 'teratasi'])->default('proses');
            $table->text('gejala');
            $table->text('penanganan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hamas');
    }
}

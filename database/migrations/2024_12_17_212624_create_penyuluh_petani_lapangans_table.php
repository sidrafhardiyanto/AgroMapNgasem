<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyuluhPetaniLapangansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ppls', function (Blueprint $table) {
            $table->id('ID_PPL'); // Primary Key
            $table->string('Nama'); // Nama PPL
            $table->string('Email')->unique(); // Email PPL
            $table->string('Password'); // Password PPL
            $table->string('No_Telepon')->nullable();
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppls');
    }
};

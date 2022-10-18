<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id');
            $table->string('subject');
            $table->string('object');
            $table->string('analisa');
            $table->string('penata_laksana');
            $table->string('complited');
            $table->string('name_pasien');
            $table->string('name');
            $table->string('poli');
            $table->string('desc');
            $table->timestamp('tanggal_kembali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
}

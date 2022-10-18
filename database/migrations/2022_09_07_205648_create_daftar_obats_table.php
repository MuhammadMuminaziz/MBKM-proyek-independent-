<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parmasi_id');
            $table->foreignId('obat_id');
            $table->string('nama_obat');
            $table->string('jumblah_obat');
            $table->string('keterangan_obat');
            $table->string('type');
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
        Schema::dropIfExists('daftar_obats');
    }
}

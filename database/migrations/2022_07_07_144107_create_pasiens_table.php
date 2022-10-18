<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kartu_rm_id');
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->string('gender');
            $table->string('job')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood')->nullable();
            $table->string('allergy')->nullable();
            $table->text('address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
        Schema::table('pasiens', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}

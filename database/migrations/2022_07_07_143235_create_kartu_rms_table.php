<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuRmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_rms', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->nullable();
            $table->string('code_ds')->nullable();
            $table->string('abjad');
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('gender');
            $table->text('address')->nullable();
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
        Schema::dropIfExists('kartu_rms');
        Schema::table('kartu_rms', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}

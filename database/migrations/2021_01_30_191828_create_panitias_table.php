<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanitiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panitia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kegiatan_id')->unsigned();
            $table->foreign('kegiatan_id')->references('id')->on('Kegiatan');
            $table->string('nama',100);
            $table->string('alamat',500);
            $table->string('no_telp',15);
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
        Schema::dropIfExists('panitia');
    }
}

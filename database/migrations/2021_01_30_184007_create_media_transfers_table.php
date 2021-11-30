<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kegiatan_id')->unsigned();
            $table->foreign('kegiatan_id')->references('id')->on('Kegiatan');
            $table->string('nomor',20);
            $table->string('nama_media',20);
            $table->string('nama_pemilik',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_transfer');
    }
}

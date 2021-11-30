<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonatursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donatur', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kegiatan_id')->unsigned();
            $table->foreign('kegiatan_id')->references('id')->on('Kegiatan');
            $table->integer('media_transfer_id')->unsigned()->nullable();
            $table->foreign('media_transfer_id')->references('id')->on('media_transfer');
            $table->string('nama',100);
            $table->integer('jumlah_donasi');
            $table->string('file_bukti',255);
            $table->string('no_hp',15);
            $table->string('status',15);
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
        Schema::dropIfExists('donatur');
    }
}

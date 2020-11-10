<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTagihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_tagihan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tagihan_id')->nullable()->unsigned();
            $table->integer('siswa_id')->nullable()->unsigned();
            $table->integer('kelas_id')->nullable()->unsigned();
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
        Schema::dropIfExists('detail_tagihan');
    }
}

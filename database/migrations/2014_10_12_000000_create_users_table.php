<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id',11);
            $table->string('nama', 50);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',191);
            // $table->string('tempat_lahir',25);
            // $table->date('tanggal_lahir');
            // $table->text('alamat');
            // $table->string('agama',10);
            // $table->string('jenis_kelamin',9);
            // $table->string('nama_wali',50);
            $table->string('role', 11)->default('siswa');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

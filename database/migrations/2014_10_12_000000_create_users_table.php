<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('nama', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telepon')->unique();
            $table->string('pendidikan_terakhir');
            $table->string('nama_institusi_pendidikan_terakhir');
            $table->string('domisili', 20);
            $table->enum('status', ['lajang','menikah', 'duda', 'janda']);
            $table->date('tanggal_lahir');
            $table->string('pekerjaan'); 
            $table->string('nomor_ktp')->unique();
            $table->string('alasan_bergabung', 250);
            $table->string('profile_picture');
            $table->enum('jenis_kelamin', ['P', 'W']);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAsatidz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ustadzs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telepon')->unique();
            $table->string('pendidikan_terakhir');
            $table->string('nama_institusi_pendidikan_terakhir');
            $table->decimal('latitude_alamat', 9, 6);
            $table->decimal('longitude_alamat', 9, 6);
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->enum('status', ['lajang','menikah', 'duda', 'janda']);
            $table->date('tanggal_lahir');
            $table->string('nomor_ktp')->unique();
            $table->string('alasan_bergabung', 250);
            $table->string('profile_picture');
            $table->string('keahlian');
            $table->enum('jenis_kelamin', ['P', 'W']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pendidikan_terakhir');
            $table->dropColumn('nama_institusi_pendidikan_terakhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ustadzs');
        Schema::table('users', function (Blueprint $table) {
            $table->string('pendidikan_terakhir');
            $table->string('nama_institusi_pendidikan_terakhir');
        });
    }
}

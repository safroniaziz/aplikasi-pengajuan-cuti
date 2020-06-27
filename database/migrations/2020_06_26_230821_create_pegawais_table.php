<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nm_pegawai');
            $table->string('slug');
            $table->enum('jenis_kelamin',['1','0']);
            $table->string('jabatan');
            $table->string('departemen');
            $table->string('level_departemen');
            $table->string('cabang');
            $table->enum('jenis_kepegawaian',['dosen','tendik_pns','tendik_non_pns']);
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
        Schema::dropIfExists('pegawais');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nm_dosen');
            $table->string('slug');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->string('prodi_kode');
            $table->string('prodi_nama');
            $table->string('fakultas_kode');
            $table->string('fakultas_nama');
            $table->string('departemen_id')->nullable();
            $table->string('departemen_nama')->nullable();
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
        Schema::dropIfExists('dosens');
    }
}

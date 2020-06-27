<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuti_id')->constrained('cutis');
            $table->foreignId('pegawai_id')->constrained('pegawais');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->text('keterangan')->nullable();
            $table->text('file_ajuan')->nullable();
            // $table->primary(['cuti_id','pegawai_id']);
            $table->enum('status',['1','2','3','4','5']);
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
        Schema::dropIfExists('cuti_pegawai');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tendiks', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nm_tendik');
            $table->string('slug');
            $table->enum('jenis_kelamin',['0','1']);
            $table->string('cabang_id');
            $table->string('cabang_nama');
            $table->string('dept_id');
            $table->string('dept_nama');
            $table->enum('jenis_kepegawaian',['tendik_pns','tendik_non_pns']);
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
        Schema::dropIfExists('tendiks');
    }
}

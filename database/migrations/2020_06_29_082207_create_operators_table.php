<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nm_operator');
            $table->string('dept_id');
            $table->string('dept_nama');
            $table->string('username')->unique();
            $table->enum('jenis_kelamin',['0','1']);
            $table->string('slug');
            $table->enum('jenis_kepegawaian',['tendik_pns','tendik_non_pns']);
            $table->string('password');
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
        Schema::dropIfExists('operators');
    }
}

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pegawai;
use Faker\Generator as Faker;

$factory->define(Pegawai::class, function (Faker $faker) {
    return [
        'nip'   =>  $faker->creditCardNumber,
        'nm_pegawai'    =>  $faker->name,
        'jenis_kelamin'    =>  $faker->randomElement(['1','2']),
        'departemen'    =>  $faker->name,
        'level_departemen'    =>  $faker->name,
        'jabatan'    =>  $faker->jobTitle,
        'cabang'    =>  $faker->jobTitle,
        'jenis_kepegawaian' =>  $faker->randomElement(['dosen','tendik_pns','tendik_non_pns']),
    ];
});

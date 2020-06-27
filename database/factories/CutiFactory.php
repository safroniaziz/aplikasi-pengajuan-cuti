<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cuti;
use Faker\Generator as Faker;

$factory->define(Cuti::class, function (Faker $faker) {
    return [
        'jenis_cuti'    =>  $faker->name,
    ];
});

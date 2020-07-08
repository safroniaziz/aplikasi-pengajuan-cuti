<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nip'   =>  $faker->creditCardNumber,
        'nm_operator'   =>  $faker->name,
        'nm_fakultas'   =>  $faker->name,
        'slug'  =>  Str::slug($faker->name),
    ];
});

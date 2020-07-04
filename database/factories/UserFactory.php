<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CiscoRouterModel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(CiscoRouterModel::class, function (Faker $faker) {
    return [
        'Sapid' => $faker->Sapid,
        'Hostname' => $faker->Hostname,
        'LoopBack' => $faker->LoopBack,
        'Mac_Address' => $faker->Mac_Address,
    ];
});

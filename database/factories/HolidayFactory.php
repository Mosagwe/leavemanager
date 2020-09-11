<?php

/** @var Factory $factory */

use App\Models\Holiday;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Holiday::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'date' => $faker->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),
        'is_annual' => $faker->boolean
    ];
});

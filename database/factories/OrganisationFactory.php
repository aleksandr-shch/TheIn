<?php

/** @var Factory $factory */

use App\Organisation;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(
    Organisation::class,
    function (Faker $faker) {
        $subbed = random_int(0, 1);

        return [
            'name' => $faker->company,
            'subscribed' => $subbed,
            'trial_end' => !$subbed ? Carbon::now()->addDays(30) : null,
        ];
    }
);

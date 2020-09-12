<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'status_id' => factory(App\TaskStatus::class),
        'created_by_id' => factory(App\User::class),
        'created_at' => time(),
        'updated_at' => time()
    ];
});

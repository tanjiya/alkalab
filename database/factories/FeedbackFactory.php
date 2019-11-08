<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\Answer;
use App\User;

use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'question_type' => 'textarea',
        'title' => $faker->realText(50),
        'question' => $faker->realText(500),
        'asked_date' => $faker->date(),
        'description' => $faker->realText(1000),
        'is_required' => true,
    ];
});

$factory->define(Answer::class, function (Faker $faker) {
    $question_ids = DB::table('questions')->pluck('id')->all();

    return [
        'user_id' => User::all()->random()->id,
        'question_id' => $faker->randomElement($question_ids),
        'answer' => $faker->realText(500),
    ];
});
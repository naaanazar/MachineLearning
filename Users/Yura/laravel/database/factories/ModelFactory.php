<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
   return [
       'title' => $faker->text,
       'description' => $faker->paragraph,
       'img_url' => Faker\Provider\Image::imageUrl(32,32),
   ];
});
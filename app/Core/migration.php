<?php

use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

require_once "config.php";
Capsule::schema()->dropIfExists('users');
Capsule::schema()->create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('login')->unique();
    $table->string('password');
    $table->string('name')->nullable();
    $table->integer('age')->nullable();
    $table->text('description')->nullable();
    $table->timestamps();
});

$faker = Faker\Factory::create();

$user = new User();
$faker = Faker\Factory::create();
for ($i = 0; $i < 15; $i++) {
    $data[$i]['login'] = $faker->userName;
    $data[$i]['password'] = $faker->password;
    $data[$i]['name'] = $faker->name;
    $data[$i]['age'] = $faker->randomDigitNotNull;
    $data[$i]['description'] = $faker->text($maxNbChars = 100);
    $user->createUser($data[$i]);
}
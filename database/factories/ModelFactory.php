<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Education\Entities\Company;
use Education\Entities\User;
use Education\Entities\Role;
use Education\Entities\Area;
use Education\Entities\Category;

$factory->define(Company::class, function ($faker) {
    return [
        'name' => $faker->company,
        'type' => 'customer'
    ];
});

$factory->defineAs(Company::class, 'developer', function ($faker) use ($factory) {
    $user = $factory->raw(Company::class);

    return array_merge($user, ['type' => 'developer']);
});

$factory->define(User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->username,
        'email' => $faker->email,
        'password' => 123,
        'remember_token' => str_random(10),
        'type' => 'registered'
    ];
});

$factory->defineAs(User::class, 'user_default', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['username' => 'miguel']);
});

$factory->defineAs(User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['type' => 'admin']);
});

$factory->defineAs(User::class, 'admin_default', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['type' => 'admin', 'username' => 'admin']);
});

$factory->defineAs(User::class, 'superadmin', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);

    return array_merge($user, ['type' => 'superadmin', 'username' => 'superadmin']);
});

$factory->define(Role::class, function ($faker) {
    return [
        'name' => $faker->unique()->name(),
        'description' => $faker->unique()->sentence(6)
    ];
});

$factory->define(Area::class, function ($faker) {
    return [
        'name' => $faker->unique()->name(),
        'description' => $faker->unique()->sentence(6)
    ];
});

$factory->define(Category::class, function ($faker) {
    return [
        'name' => $faker->unique()->name(),
        'description' => $faker->unique()->sentence(6)
    ];
});


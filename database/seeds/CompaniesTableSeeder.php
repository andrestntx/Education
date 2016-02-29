<?php


use \Illuminate\Database\Seeder;
use Education\Entities\Company;
use Education\Entities\User;
use Education\Entities\Role;
use Education\Entities\Area;
use Education\Entities\Category;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        $company = factory(Company::class)->create();

        $company->users()->save(factory(User::class, 'admin_default')->make());
        $company->users()->save(factory(User::class, 'user_default')->make());

        $company->users()->saveMany(factory(User::class, 5)->make())->each(function ($user) {
            $user->rolesCreated()->saveMany(factory(Role::class, 2)->make());
            $user->areasCreated()->saveMany(factory(Area::class, 2)->make());
            $user->categoriesCreated()->saveMany(factory(Category::class, 2)->make());
        });

        /* 
        *
        * Relleno
        */
        $companies = factory(Company::class, 2)->create()->each(function ($company) {
            $company->users()->saveMany(factory(User::class, 'admin', 2)->make());

            $company->users()->saveMany(factory(User::class, 5)->make())->each(function ($user) {
                $user->rolesCreated()->saveMany(factory(Role::class, 2)->make());
                $user->areasCreated()->saveMany(factory(Area::class, 2)->make());
                $user->categoriesCreated()->saveMany(factory(Category::class, 2)->make());
            });
        });
    }
}

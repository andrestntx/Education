<?php

use \Illuminate\Database\Seeder;
use Education\Entities\Company;
use Education\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Eloquent::unguard();

        $company = factory(Company::class, 'developer')->create()
            ->users()->save(factory(User::class, 'superadmin')->make());

        if(env('APP_ENV') != 'production') {
        	$this->call('CompaniesTableSeeder'); // Static
    	}
    }
}

/*
* 
*/

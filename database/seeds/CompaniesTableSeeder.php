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
    	$company = factory(Company::class, 'developer')->create()
    		->users()->save(factory(User::class, 'superadmin')->make());

    	$companies = factory(Company::class, 2)->create()->each(function($company) {
	        $company->users()->saveMany(factory(User::class, 'admin', 2)->make());
	        $company->users()->saveMany(factory(User::class, 5)->make());

	        $company->roles()->saveMany(factory(Role::class, 5)->make());
	        $company->areas()->saveMany(factory(Area::class, 5)->make());
	        $company->categories()->saveMany(factory(Category::class, 5)->make());
	    });
	}
}

?>
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
	        $company->users()->save(factory(User::class, 'admin')->make());

	        $company->users()->saveMany(factory(User::class, 5)->make())->each(function($user) {
                $user->rolesCreated()->saveMany(factory(Role::class, 2)->make());
                $user->areasCreated()->saveMany(factory(Area::class, 2)->make());
                $user->categoriesCreated()->saveMany(factory(Category::class, 2)->make());
            });
	    });
	}
}

?>
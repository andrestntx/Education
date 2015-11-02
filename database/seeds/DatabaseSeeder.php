<?php

use \Illuminate\Database\Seeder;
use Laravel\Libraries\Campaing;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('UserTypesTableSeeder'); // Static
		$this->call('UsersTableSeeder'); // Static
		
	}

}

/**
* 
*/

<?php 

use \Illuminate\Database\Seeder;
use Education\Entities\CompanyType;

class CompanyTypesTableSeeder extends Seeder
{
    public function run()
    {
    	CompanyType::create([
    		'name'    		=> 'developer',
    		'description'	=> 'Empresa Desarrolladora NM'
    	]);

    	CompanyType::create([
    		'name'    		=> 'customer',
    		'description'	=> 'Empresa Cliente'
    	]);

    }
}

?>
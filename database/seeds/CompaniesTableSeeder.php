<?php 

use \Illuminate\Database\Seeder;
use Education\Entities\Company;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
    	Company::create([
    		'name'    => 'Empresa de Prueba',
            'type_id' => 1   
    	]);
    }
}

?>
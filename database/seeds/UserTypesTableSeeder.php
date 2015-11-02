<?php 

use \Illuminate\Database\Seeder;
use Laravel\Entities\UserType;

class UserTypesTableSeeder extends Seeder
{
    public function run()
    {
    	UserType::create([
    		'name'    => 'Súper Aministrador',
    	]);

    	UserType::create([
    		'name' => 'Aministrador de Campaña'
    	]);

    	UserType::create([
    		'name' => 'Digitador'
    	]);

        UserType::create([
            'name' => 'Invitado'
        ]);
    }
}

?>
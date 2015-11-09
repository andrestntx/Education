<?php 

use \Illuminate\Database\Seeder;
use Education\Entities\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'          => 'Súper Administrador',
            'username'      => 'superadmin',
            'email'         => 'superadmin@Laravel.info',
            'password'      => 123,
            'type'          => 'superadmin',
            'company_id'    => 1,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        User::create([
            'name'          => 'Admin',
            'username'      => 'admin',
            'email'         => 'admin@Laravel.info',
            'password'      => 123,
            'type'          => 'admin',
            'company_id'    => 1,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);
    }
}

?>
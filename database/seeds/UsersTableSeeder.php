<?php 

use \Illuminate\Database\Seeder;
use Laravel\Entities\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'          => 'Súper Administrador',
            'username'      => 'superadmin',
            'email'         => 'superadmin@Laravel.info',
            'password'      => 123,
            'type_id'       => 1,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        User::create([
            'name'          => 'Andrés Pinzón',
            'username'      => 'admin',
            'email'         => 'andrestntx@Laravel.info',
            'password'      => 123,
            'type_id'       => 2,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);

        User::create([
            'name'          => 'Digitadora Ana Maria',
            'username'      => 'ana',
            'email'         => 'admin@Laravel.info',
            'password'      => 123,
            'type_id'       => 3,
            'created_at'    => new DateTime,
            'updated_at'    => new DateTime 
        ]);
    }
}

?>
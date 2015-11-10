<?php 

use \Illuminate\Database\Seeder;
use Education\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'Administrador del Sistema',
            'company_id' => 1,
        ]);

        Role::create([
            'name' => 'Perfil Por Defecto',
            'description' => 'Perfil Por Defecto',
            'company_id' => 2,
        ]); 

        Role::create([
            'name' => 'MEDICO GENERAL',
            'description' => 'MEDG',
            'company_id' => 2,
        ]); 

        Role::create([
            'name' => 'MEDICO ESPECIALISTA',
            'description' => 'MEDE',
            'company_id' => 2,
        ]); 

        Role::create([
            'name' => 'ENFERMERA PROFESIONAL',
            'description' => 'ENFA',
            'company_id' => 2,
        ]); 

        Role::create([
            'name' => 'TERAPEUTA RESPIRATORIA',
            'description' => 'TERR',
            'company_id' => 2,
        ]); 

        Role::create([
            'name' => 'ESTUDIANTE',
            'description' => 'ESTUDIA MEDICINA',
            'company_id' => 2,
        ]); 
    }
}

?>
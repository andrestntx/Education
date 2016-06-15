<?php

use Illuminate\Database\Migrations\Migration;

class CreateAllowedUsersView extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement(
            'CREATE VIEW allowed_users AS ('.
                'SELECT DISTINCT area_user.user_id, allowed_roles.allowed_roles_id as allowed_users_id, allowed_roles.allowed_roles_type as allowed_users_type '.
                'FROM users '.
                'join area_user on '.
                    'area_user.user_id = users.id '.
                'join role_user on '.
                    'role_user.user_id = users.id '.
                'join allowed_areas on '.
                    'allowed_areas.area_id = area_user.area_id '.
                'join allowed_roles on '.
                    'allowed_roles.role_id = role_user.role_id '.
                    'and allowed_roles.allowed_roles_id = allowed_areas.allowed_areas_id'.
            ')'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::select('DROP VIEW allowed_users');
    }
}

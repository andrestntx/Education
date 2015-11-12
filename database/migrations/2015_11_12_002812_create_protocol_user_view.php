<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::select(
            'CREATE VIEW protocol_user AS (' .
                'SELECT DISTINCT area_user.user_id, protocol_role.protocol_id ' .
                'FROM users ' .
                'join area_user on ' .
                    'area_user.user_id = users.id ' .
                'join role_user on ' .
                    'role_user.user_id = users.id ' .
                'join area_protocol on ' .
                    'area_protocol.area_id = area_user.area_id ' .
                'join protocol_role on ' .
                    'protocol_role.role_id = role_user.role_id ' .
                    'and protocol_role.protocol_id = area_protocol.protocol_id' .
            ')'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('protocol_user');
    }
}

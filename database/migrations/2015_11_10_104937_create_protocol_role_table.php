<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocol_role', function (Blueprint $table) {
            $table->integer('protocol_id')->unsigned();
            $table->foreign('protocol_id')
              ->references('id')->on('protocols')
              ->onUpdate('cascade');
    
            $table->integer('role_id')->unsigned();       
            $table->foreign('role_id')
              ->references('id')->on('roles')
              ->onUpdate('cascade');

            $table->primary(['protocol_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('protocol_role');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllowedRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowed_roles', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('allowed_roles_id')->unsigned();     
            $table->string('allowed_roles_type');
    
            $table->integer('role_id')->unsigned();       
            $table->foreign('role_id')
              ->references('id')->on('roles')
              ->onUpdate('cascade');

            //$table->unique(['allowed_roles_id', 'allowed_roles_type', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('allowed_roles');
    }
}

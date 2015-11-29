<?php

use Illuminate\Database\Migrations\Migration;

class CreateAreaUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('area_user', function ($table) {

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onUpdate('cascade');

            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')
              ->references('id')->on('areas')
              ->onUpdate('cascade');

            $table->primary(array('user_id', 'area_id'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('area_user');
    }
}

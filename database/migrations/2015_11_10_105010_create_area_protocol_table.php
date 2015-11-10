<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaProtocolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_protocol', function (Blueprint $table) {
            $table->integer('area_id')->unsigned();       
            $table->foreign('area_id')
              ->references('id')->on('roles')
              ->onUpdate('cascade');

            $table->integer('protocol_id')->unsigned();
            $table->foreign('protocol_id')
              ->references('id')->on('protocols')
              ->onUpdate('cascade');
    
            $table->primary(['protocol_id', 'area_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('area_protocol');
    }
}

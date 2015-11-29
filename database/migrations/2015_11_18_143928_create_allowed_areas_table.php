<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllowedAreasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('allowed_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('allowed_areas_id')->unsigned();
            $table->string('allowed_areas_type');

            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')
              ->references('id')->on('areas')
              ->onUpdate('cascade');

            //$table->unique(['allowed_areas_id', 'allowed_areas_type', 'area_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('allowed_areas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('questions', function ($table) {
            $table->increments('id');
            $table->text('text');

            $table->boolean('aviable')->default(true)->nullable();
            $table->integer('document_id')->unsigned();
            $table->string('document_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('questions');
    }
}

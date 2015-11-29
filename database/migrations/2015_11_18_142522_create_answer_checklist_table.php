<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerChecklistTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answer_checklist', function (Blueprint $table) {
            $table->integer('checklist_id')->unsigned();
            $table->foreign('checklist_id')
              ->references('id')->on('checklists')
              ->onUpdate('cascade');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')
              ->references('id')->on('answers')
              ->onUpdate('cascade');

            $table->primary(['checklist_id', 'answer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('answer_checklist');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGeneratorIdGeneratedProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generated_protocols', function (Blueprint $table) {
            $table->integer('generator_id')->unsigned()->nullable();

            $table->foreign('generator_id')
              ->references('id')->on('generators')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generated_protocols', function (Blueprint $table) {
            $table->dropForeign('generated_protocols_generator_id_foreign');
            $table->dropColumn('generator_id');
        });
    }
}

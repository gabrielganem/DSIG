<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('fields', function (Blueprint $table) {
          $table->increments('id');
          $table->text('value');
          $table->integer('sample_id')->unsigned;
          $table->integer('label_id')->unsigned;
          $table->timestamps();
      });

      Schema::table('fields', function($table) {
          $table->foreign('sample_id')->references('id')->on('samples');
          $table->foreign('label_id')->references('id')->on('labels');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

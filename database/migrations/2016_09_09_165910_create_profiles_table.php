<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('profiles', function (Blueprint $table) {
          $table->increments('id');
          $table->text('biography');
          $table->integer('institute_id')->unsigned;
          $table->timestamps();
      });

      Schema::table('profiles', function($table) {
          $table->foreign('institute_id')->references('id')->on('institutes');
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('project_user', function (Blueprint $table) {

        $table->integer('project_id')->unsigned;
        $table->integer('user_id')->unsigned;
        $table->boolean('role');

        $table->primary(['project_id', 'user_id']);

        $table->foreign('project_id')->references('id')->on('projects')
                  ->onUpdated('cascade')
                  ->onDelete('cascade');

        $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdated('cascade')
                  ->onDelete('cascade');
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

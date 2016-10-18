<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->boolean('private');
            $table->integer('user_id')->unsigned;
            $table->integer('institute_id')->unsigned;
            $table->timestamps();
        });

        Schema::table('projects', function($table) {
            $table->foreign('user_id')->references('id')->on('users')
                   ->onDelete('cascade')->onUpdated('cascade');
        });

        Schema::table('projects', function($table) {
            $table->foreign('institute_id')->references('id')->on('institutes')
                   ->onDelete('cascade')->onUpdated('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}

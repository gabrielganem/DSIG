<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('label_id')->unsigned;
            $table->integer('project_id')->unsigned;
            $table->dateTime('date');
        });

       Schema::table('samples', function($table) {
           $table->foreign('label_id')->references('id')->on('labels');
       });

       Schema::table('samples', function($table) {
           $table->foreign('project_id')->references('id')->on('projects');
       });
        
        DB::unprepared("ALTER TABLE samples ADD COLUMN geom GEOMETRY(POINT, 4326)"); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('samples');
    }
}

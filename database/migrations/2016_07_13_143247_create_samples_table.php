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
            $table->integer('project_id')->unsigned;
            $table->dateTime('date');
        });

       Schema::table('samples', function($table) {
           $table->foreign('project_id')->references('id')->on('projects')
                  ->onDelete('cascade')->onUpdated('cascade');
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

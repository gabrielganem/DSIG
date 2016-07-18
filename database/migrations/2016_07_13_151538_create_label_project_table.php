<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_project', function (Blueprint $table) {
            $table->integer('label_id')->unsigned;
            $table->integer('project_id')->unsigned;

           $table->primary(['label_id', 'project_id']);

           $table->foreign('label_id')->references('id')->on('labels')
                    ->onUpdated('cascade')
                    ->onDelete('cascade');
                    
           $table->foreign('project_id')->references('id')->on('projects')
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
        Schema::drop('label_project');
    }
}

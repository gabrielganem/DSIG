<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('institutes', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->text('name');
      });

      DB::unprepared("ALTER TABLE institutes ADD COLUMN geom GEOMETRY(POINT, 4326)");
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiverHeightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_heights', function (Blueprint $table) {
            $table->id();
            $table->integer('river_id')->unsigned();
            $table->string('height');
            $table->string('status');
            $table->timestamps();

            // $table->foreign('river_id')->references('id')->on('rivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('river_heights');
    }
}

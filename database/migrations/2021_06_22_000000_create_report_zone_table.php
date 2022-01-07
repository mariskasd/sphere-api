<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('category');
            $table->longText('description');
            $table->string('latitude');
            $table->string('longitude');
            $table->longText('address');
            $table->string('image');
            $table->integer('assigned_id')->unsigned()->nullable();
            $table->boolean('solved');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assigned_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}

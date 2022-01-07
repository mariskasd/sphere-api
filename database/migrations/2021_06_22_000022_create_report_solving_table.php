<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportSolvingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports_solving', function (Blueprint $table) {
            $table->id();
            $table->integer('reports_id')->unsigned();
            $table->string('photo');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();

            // $table->foreign('reports_id')->references('id')->on('reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports_solving');
    }
}

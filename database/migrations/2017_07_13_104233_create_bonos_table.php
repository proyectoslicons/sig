<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bono', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id')->unsigned();
            $table->double('cantidad', 15, 2);
            $table->foreign('position_id')->references('id')->on('position');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bono');
    }
}

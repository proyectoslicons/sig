<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumento', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('department_id')->unsigned();
            $table->integer('position_id')->unsigned();            
            $table->string('descripcion');            
            $table->double('porcentaje', 15, 2);
            $table->foreign('department_id')->references('id')->on('department');
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
        Schema::dropIfExists('instrumento');
    }
}

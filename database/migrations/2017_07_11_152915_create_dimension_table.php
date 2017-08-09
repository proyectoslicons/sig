<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDimensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimension', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('instrumento_id')->unsigned();           
            $table->string('descripcion');            
            $table->double('porcentaje', 15, 2);
            $table->foreign('instrumento_id')->references('id')->on('instrumento');                    
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
        Schema::dropIfExists('dimension');
    }
}

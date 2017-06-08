<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tickets table migration showing only the up() schemas with our modifications 
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('user_default_id')->unsigned();
            $table->integer('user_assigned_id')->unsigned();            
            $table->integer('category_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('ticket_id')->unique();
            $table->string('title');
            $table->string('priority');
            $table->integer('type');
            $table->text('message');
            $table->string('status');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_default_id')->references('id')->on('users');
            $table->foreign('user_assigned_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('department_id')->references('id')->on('department');
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
        Schema::dropIfExists('tickets');
    }
}

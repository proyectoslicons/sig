<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id')->unique();
            $table->integer('user_id')->unsigned();
            $table->string('foto');
            $table->string('mensaje');
            $table->string('nombre');
            $table->integer('status')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ticket_notification');
    }
}

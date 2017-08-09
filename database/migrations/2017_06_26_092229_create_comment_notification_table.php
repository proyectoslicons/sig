<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id');
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
        Schema::dropIfExists('attachment');
    }
}

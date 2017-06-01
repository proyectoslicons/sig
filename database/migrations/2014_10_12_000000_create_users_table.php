<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primer_nombre');
            $table->string('segundo_nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->date('fecha_ingreso');
            $table->string('direccion');
            $table->string('telefono_habitacion');
            $table->string('telefono_movil');
            $table->string('extension');
            $table->string('profesion');
            $table->integer('departamento_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->double('sueldo', 15, 2);
            $table->integer('cargas');
            $table->integer('pareja');
            $table->integer('hijos');
            $table->string('estado_civil');
            $table->string('lugar_nacimiento');
            $table->date('fecha_egreso')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('is_admin')->unsigned()->default(0);
            $table->integer('is_coordinator')->unsigned()->default(0);
            $table->integer('is_auditor')->unsigned()->default(0);
            $table->integer('is_active')->unsigned()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

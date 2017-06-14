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
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('cedula')->unique();
            $table->string('rif')->unique();
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('sexo');
            $table->date('fecha_ingreso');
            $table->string('direccion');
            $table->string('telefono_habitacion');
            $table->string('telefono_movil');
            $table->string('telefono_corporativo')->nullable();
            $table->string('extension')->nullable();
            $table->integer('profesion_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->double('sueldo', 15, 2);
            $table->integer('cargas');
            $table->string('estado_civil');
            $table->integer('lugar_nacimiento')->unsigned();
            $table->date('fecha_egreso')->nullable();
            $table->string('email_personal')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->integer('is_admin')->unsigned()->default(0);
            $table->integer('is_auditor')->unsigned()->default(0);
            $table->integer('is_active')->unsigned()->default(1);
            $table->foreign('profesion_id')->references('id')->on('occupation');
            $table->foreign('departamento_id')->references('id')->on('department');
            $table->foreign('cargo_id')->references('id')->on('position');
            $table->foreign('lugar_nacimiento')->references('id')->on('city');
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



<?php

use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Occupation::create([ 'name' => 'Ingeniero Ambiental']);                                             
        App\Occupation::create([ 'name' => 'Ingeniero de Sistemas']);
        App\Occupation::create([ 'name' => 'Ingeniero Electricista']);
        App\Occupation::create([ 'name' => 'Ingeniero en Electrónica']);
        App\Occupation::create([ 'name' => 'Ingeniero en Informática']);
        App\Occupation::create([ 'name' => 'Ingeniero en Telecomunicaciones']);
        App\Occupation::create([ 'name' => 'Ingeniero en Mantenimiento Industrial']);
        App\Occupation::create([ 'name' => 'Ingeniero en Mantenimiento Mecánico']);
        App\Occupation::create([ 'name' => 'Ingeniero Industrial']);
        App\Occupation::create([ 'name' => 'Ingeniero Mecánico']);
        App\Occupation::create([ 'name' => 'Licenciatura en Admnistración de Recursos Financieros']);
        App\Occupation::create([ 'name' => 'Licenciatura en Contaduría pública']);
        App\Occupation::create([ 'name' => 'Licenciatura en Administración']);
        App\Occupation::create([ 'name' => 'Licenciatura en Gerencia de RRHH']);
        App\Occupation::create([ 'name' => 'T.S.U en Administración Contabilidad y Finanzas']);
        App\Occupation::create([ 'name' => 'T.S.U Banca y Finanzas']);
        App\Occupation::create([ 'name' => 'T.S.U en Contaduría']);
        App\Occupation::create([ 'name' => 'T.S.U en Construcción Civíl']);
        App\Occupation::create([ 'name' => 'T.S.U en Electrónica']);
        App\Occupation::create([ 'name' => 'T.S.U en Electrónica Industrial']);
        App\Occupation::create([ 'name' => 'T.S.U en Informática']);
        App\Occupation::create([ 'name' => 'T.S.U en Mantenimiento Industrial']);
        App\Occupation::create([ 'name' => 'T.S.U en Mantenimiento de Maquinaria Agrícola']);
        App\Occupation::create([ 'name' => 'Técnico Medio en Electricidad']);
        App\Occupation::create([ 'name' => 'Técnico Medio en Electricidad Mecánica']);
        App\Occupation::create([ 'name' => 'Técnico Medio en Informática']);
        App\Occupation::create([ 'name' => 'Técnico Medio en Mecánica de Producción']);
        App\Occupation::create([ 'name' => 'Pasante']);
        App\Occupation::create([ 'name' => 'Bachiller']);
        App\Occupation::create([ 'name' => 'Educación Básica']);
    }
}

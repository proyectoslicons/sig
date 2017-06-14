<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Department::create([
            'name'      => 'Tecnología y Marketing',
            'iniciales' => 'TYM',            
        ]);

        App\Department::create([
            'name'      => 'Gestión Empresarial',
            'iniciales' => 'GEM',            
        ]);

        App\Department::create([
            'name'      => 'Talento Humano',
            'iniciales' => 'THU',            
        ]);

        App\Department::create([
            'name'      => 'Contabilidad y Finanzas',
            'iniciales' => 'CYF',            
        ]);

        App\Department::create([
            'name'      => 'Compras y Almacen',
            'iniciales' => 'CYA',            
        ]);

        App\Department::create([
            'name'      => 'Taller Metalmecánico',
            'iniciales' => 'TMT',            
        ]);

        App\Department::create([
            'name'      => 'Logística y Transporte',
            'iniciales' => 'LYT',            
        ]);

        App\Department::create([
            'name'      => 'Dierección General',
            'iniciales' => 'DIG',            
        ]);

        App\Department::create([
            'name'      => 'Gerencia General',
            'iniciales' => 'GGE',            
        ]);

        App\Department::create([
            'name'      => 'MP e Incidencias SIMET',
            'iniciales' => 'MPS',            
        ]);

        App\Department::create([
            'name'      => 'MCP y Empresas SIMET',
            'iniciales' => 'MCS',            
        ]);
    }
}

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
            'name'      => 'Compras',
            'iniciales' => 'COM',            
        ]);

        App\Department::create([
            'name'      => 'Almacen',
            'iniciales' => 'ALM',            
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
            'name'      => 'Dirección General',
            'iniciales' => 'DIG',            
        ]);

        App\Department::create([
            'name'      => 'Gerencia General',
            'iniciales' => 'GGE',            
        ]);

        App\Department::create([
            'name'      => 'SIMET',
            'iniciales' => 'SIM',            
        ]);

        App\Department::create([            
            'name'      => 'SIMET Maracaibo',
            'iniciales' => 'SMA',            
        ]);
        
        App\Department::create([
            'name'      => 'SIMET San Cristobal',
            'iniciales' => 'SSC',            
        ]);
        
        App\Department::create([
            'name'      => 'SIMET El Vigia',
            'iniciales' => 'SEV',            
        ]);
        
        App\Department::create([
            'name'      => 'SIMET Mérida',
            'iniciales' => 'SME',            
        ]);
        
        App\Department::create([
            'name'      => 'SIMET Valera',
            'iniciales' => 'SVA',            
        ]);        
        
        App\Department::create([
            'name'      => 'SIMET Col',
            'iniciales' => 'SCL',            
        ]);

        App\Department::create([
            'name'      => 'SIMET Coro',
            'iniciales' => 'SCR',            
        ]);
        
        App\Department::create([
            'name'      => 'SIMET Punto Fijo',
            'iniciales' => 'SPF',            
        ]);

        App\Department::create([
            'name'      => 'Mantenimiento Correctivo Programado y Empresas SIMET',
            'iniciales' => 'MCS',            
        ]);

        App\Department::create([
            'name'      => 'Mantenimiento Preventivo e Incidencias SIMET',
            'iniciales' => 'MPS',            
        ]);
    }
}

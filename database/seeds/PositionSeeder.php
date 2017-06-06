<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        App\Position::create([
            'name' => 'Director General'             
        ]);

        App\Position::create([
            'name' => 'Gerente General'             
        ]);

        App\Position::create([
            'name' => 'Gerente Unidad Funcional'             
        ]);
        
        App\Position::create([
            'name' => 'Coordinador'             
        ]);

        App\Position::create([
            'name' => 'Analista'             
        ]);
    }
}

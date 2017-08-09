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
        App\Position::create(['name' => 'Director General'              ]);
        App\Position::create(['name' => 'Sub-Director General'          ]);
        App\Position::create(['name' => 'Gerente General'               ]);
        App\Position::create(['name' => 'Asesor Financiero'             ]);
        App\Position::create(['name' => 'Gerente'                       ]);
        App\Position::create(['name' => 'Coordinador'                   ]);
        App\Position::create(['name' => 'Coordinador General Operativo' ]); 
        App\Position::create(['name' => 'Analista'                      ]);
        App\Position::create(['name' => 'Supervisor'                    ]);
        App\Position::create(['name' => 'Pasante'                       ]);
        App\Position::create(['name' => 'Soporte'                       ]);
        App\Position::create(['name' => 'Especialista Telecom'          ]);
        App\Position::create(['name' => 'Técnico Infra'                 ]);        
        App\Position::create(['name' => 'Torrero'                       ]);
        App\Position::create(['name' => 'Chofer'                        ]);       
        App\Position::create(['name' => 'Operario'                      ]);
        App\Position::create(['name' => 'Recepcionista'                 ]);
        App\Position::create(['name' => 'Mensajero'                     ]);        
        App\Position::create(['name' => 'Personal de Limpieza'          ]);
        App\Position::create(['name' => 'Almacenista'                   ]);                
    }
}

<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        App\State::create(['name' => 'Amazonas',                'country_id' => 1 ]);        
        App\State::create(['name' => 'Anzoátegui',              'country_id' => 1 ]);
        App\State::create(['name' => 'Apure',                   'country_id' => 1 ]);
        App\State::create(['name' => 'Aragua',                  'country_id' => 1 ]);
        App\State::create(['name' => 'Barinas',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Bolívar',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Carabobo',                'country_id' => 1 ]);
        App\State::create(['name' => 'Cojedes',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Delta Amacuro',           'country_id' => 1 ]);
        App\State::create(['name' => 'Falcón',                  'country_id' => 1 ]);
        App\State::create(['name' => 'Guárico',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Lara',                    'country_id' => 1 ]);
        App\State::create(['name' => 'Mérida',                  'country_id' => 1 ]);
        App\State::create(['name' => 'Miranda',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Monagas',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Nueva Esparta',           'country_id' => 1 ]);
        App\State::create(['name' => 'Portuguesa',              'country_id' => 1 ]);
        App\State::create(['name' => 'Sucre',                   'country_id' => 1 ]);
        App\State::create(['name' => 'Táchira',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Trujillo',                'country_id' => 1 ]);
        App\State::create(['name' => 'Vargas',                  'country_id' => 1 ]);
        App\State::create(['name' => 'Yaracuy',                 'country_id' => 1 ]);
        App\State::create(['name' => 'Zulia',                   'country_id' => 1 ]);
        App\State::create(['name' => 'Distrito Capital',        'country_id' => 1 ]);
        App\State::create(['name' => 'Dependencias Federales',  'country_id' => 1 ]);
    }
}

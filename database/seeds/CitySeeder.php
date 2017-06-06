<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\City::create([
            'name' => 'San cristóbal',
            'state_id' => 1           
        ]);
    }
}

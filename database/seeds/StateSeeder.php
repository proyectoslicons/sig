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
        App\State::create([
            'name' => 'Táchira',
            'country_id' => 1             
        ]);
    }
}

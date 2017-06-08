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
        App\Occupation::create([
            'name' => 'Ingeniero en Informática'             
        ]);

        App\Occupation::create([
            'name' => 'Ingeniero en Sistemas'             
        ]);
    }
}

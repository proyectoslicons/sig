<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

          foreach(range(102,3000) as $index)
        {
            App\User::create([
                'name' => $faker->word,
                'email' => $faker->email.$index,
                'password' => bcrypt('secret'),
            ]);
        }
    }
}

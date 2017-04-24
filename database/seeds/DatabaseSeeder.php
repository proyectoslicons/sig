<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class)->create([
             'name' => 'admin',
             'email' => 'admin@grupolaitaliana.com',
             'password' => bcrypt('admin')             
         ]);
    }
}

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
        App\User::create([
            'primer_nombre' => 'Joel', 
            'segundo_nombre' => 'Xavier', 
            'primer_apellido' => 'Heredia', 
            'segundo_apellido' => 'Cárdenas', 
            'cedula' => 'V-20123873', 
            'fecha_nacimiento' => '1991-11-05', 
            'fecha_ingreso' => '2017-04-07',
            'direccion' => 'Calle 16', 
            'telefono_habitacion' => '02763473273', 
            'telefono_movil' => '04247027112', 
            'extension' => '43', 
            'profesion' => 'Ingeniero en Informática', 
            'departamento_id' => 1, 
            'cargo_id' => 1, 
            'sueldo' => 0, 
            'cargas' => 0, 
            'pareja' => 0, 
            'hijos' => 0, 
            'estado_civil' => 'Soltero', 
            'lugar_nacimiento' => 'San Cristóbal', 
            'fecha_egreso' => NULL, 
            'email' => 'informatica@grupolaitaliana.com', 
            'password' => bcrypt('admin'), 
            'is_admin' => 1, 
            'is_coordinator' => 1, 
            'is_auditor' => 0, 
            'is_active' => 1,
        ]);

        $faker = Faker::create();

        $i = 1;
          foreach(range(2,3000) as $index)
        {
            App\User::create([
                'primer_nombre' => $faker->firstName($gender = null), 
                'segundo_nombre' => $faker->firstName($gender = null), 
                'primer_apellido' => $faker->lastName, 
                'segundo_apellido' => $faker->lastName, 
                'cedula' => 'V-'.$i, 
                'fecha_nacimiento' => $faker->date($format ='Y-m-d', $max ='now'), 
                'fecha_ingreso' => $faker->date($format = 'Y-m-d', $max ='now'),
                'direccion' => $faker->streetAddress, 
                'telefono_habitacion' => $faker->e164PhoneNumber, 
                'telefono_movil' => $faker->e164PhoneNumber, 
                'extension' => $i, 
                'profesion' => $faker->word, 
                'departamento_id' => 1, 
                'cargo_id' => 1, 
                'sueldo' => 0, 
                'cargas' => 0, 
                'pareja' => 0, 
                'hijos' => 0, 
                'estado_civil' => 'Soltero', 
                'lugar_nacimiento' => 'San Cristóbal', 
                'fecha_egreso' => NULL, 
                'email' => $faker->email.$i, 
                'password' => bcrypt('secret'), 
                'is_admin' => 0, 
                'is_coordinator' => 0, 
                'is_auditor' => 0, 
                'is_active' => 1,
            ]);
            $i++;
        }
    }
}

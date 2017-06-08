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
            'primer_nombre'         => 'Joel', 
            'segundo_nombre'        => 'Xavier', 
            'primer_apellido'       => 'Heredia', 
            'segundo_apellido'      => 'Cárdenas', 
            'cedula'                => 'V-20123873',
            'rif'                   => 'V-20123873-7',
            'fecha_nacimiento'      => '1991-11-05', 
            'edad'                  => 25,
            'sexo'                  => 'M',
            'fecha_ingreso'         => '2017-04-07',
            'direccion'             => 'Calle 16', 
            'telefono_habitacion'   => '02763473273', 
            'telefono_movil'        => '04247027112', 
            'telefono_corporativo'  => NULL, 
            'extension'             => '43', 
            'profesion_id'          => 1, 
            'departamento_id'       => 1, 
            'cargo_id'              => 1, 
            'sueldo'                => 201000, 
            'cargas'                => 0, 
            'estado_civil'          => 'Soltero', 
            'lugar_nacimiento'      => 1, 
            'fecha_egreso'          => NULL, 
            'email_personal'        => 'joelxheredia@gmail.com', 
            'email'                 => 'jheredia@grupolaitaliana.com', 
            'password'              => bcrypt('admin'), 
            'is_admin'              => 1,             
            'is_auditor'            => 0, 
            'is_active'             => 1,
        ]);

        /*$faker = Faker::create();

        $i = 1;
        foreach(range(2,300) as $index){
            App\User::create([
                'primer_nombre'         => $faker->firstName($gender = null), 
                'segundo_nombre'        => $faker->firstName($gender = null), 
                'primer_apellido'       => $faker->lastName, 
                'segundo_apellido'      => $faker->lastName, 
                'cedula'                => 'V-' . $i, 
                'rif'                   => 'V-' . $i . '-7',
                'fecha_nacimiento'      => $faker->date($format ='Y-m-d', $max ='now'),
                'edad'                  => 30,
                'sexo'                  => 'M', 
                'fecha_ingreso'         => $faker->date($format = 'Y-m-d', $max ='now'),
                'direccion'             => $faker->streetAddress, 
                'telefono_habitacion'   => $faker->e164PhoneNumber, 
                'telefono_movil'        => $faker->e164PhoneNumber, 
                'telefono_corporativo'  => $faker->e164PhoneNumber, 
                'extension'             => $i, 
                'profesion_id'          => 1, 
                'departamento_id'       => 1, 
                'cargo_id'              => 1, 
                'sueldo'                => 0, 
                'cargas'                => 0, 
                'estado_civil'          => 'Soltero', 
                'lugar_nacimiento'      => 1, 
                'fecha_egreso'          => NULL, 
                'email_personal'        => $i . $faker->email,
                'email'                 => $i . $faker->email, 
                'password'              => bcrypt('secret'), 
                'is_admin'              => 0,                 
                'is_auditor'            => 0, 
                'is_active'             => 1,
            ]);
            $i++;
        }*/
    }
}

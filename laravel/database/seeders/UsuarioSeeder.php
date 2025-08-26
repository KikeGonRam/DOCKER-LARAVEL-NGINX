<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        $total = 10000;
        $batch = 50;
        $usuarios = [];
        for ($i = 1; $i <= $total; $i++) {
            $usuarios[] = [
                'nombre' => $faker->firstName,
                'apellido_paterno' => $faker->lastName,
                'apellido_materno' => $faker->lastName,
                'fecha_nacimiento' => $faker->date('Y-m-d', '-18 years'),
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if ($i % $batch === 0) {
                Usuario::insert($usuarios);
                $usuarios = [];
            }
        }
        // Insertar los que queden
        if (count($usuarios)) {
            Usuario::insert($usuarios);
        }
    }
}

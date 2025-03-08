<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {

        $now = Carbon::now();

        Usuario::create([
            'nombre' => 'Juan Carlos',
            'email' => 'juancarlosprado@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 2,
            'roles_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);    
        
        Usuario::create([
            'nombre' => 'Christian',
            'email' => 'christianmonrabal@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1,
            'roles_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Usuario::create([
            'nombre' => 'Pol Marc',
            'email' => 'polmarcmontero@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1,
            'roles_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        Usuario::create([
            'nombre' => 'Daniel',
            'email' => 'danielbecerra@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1,
            'roles_id' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        Usuario::create([
            'nombre' => 'Gestor 1',
            'email' => 'gestor1@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1,
            'roles_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        Usuario::create([
            'nombre' => 'Gestor 2',
            'email' => 'gestor2@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 2,
            'roles_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
    }
}

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

/*1*/   Usuario::create([
            'nombre' => 'Juan Carlos',
            'email' => 'juancarlosprado@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 2, // Berlin
            'roles_id' => 1, // Cliente
            'created_at' => $now,
            'updated_at' => $now,
        ]);    
        
/*2*/   Usuario::create([
            'nombre' => 'Christian',
            'email' => 'christianmonrabal@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1, // Barcelona
            'roles_id' => 2, // Administrador
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*3*/   Usuario::create([
            'nombre' => 'Pol Marc',
            'email' => 'polmarcmontero@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 3, // Montreal
            'roles_id' => 3, // Gestor
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
/*4*/   Usuario::create([
            'nombre' => 'Daniel',
            'email' => 'danielbecerra@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1, // Barcelona
            'roles_id' => 4, // Tecnico
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
/*5*/   Usuario::create([
            'nombre' => 'Gestor 1',
            'email' => 'gestor1@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1, // Barcelona
            'roles_id' => 3, // Gestor
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
/*6*/   Usuario::create([
            'nombre' => 'Gestor 2',
            'email' => 'gestor2@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 2, // Berlin
            'roles_id' => 3, // Gestor
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*7*/   Usuario::create([
            'nombre' => 'Tecnico 1',
            'email' => 'tecnico1@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1, // Barcelona
            'roles_id' => 4, // Tecnico
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*8*/   Usuario::create([
            'nombre' => 'Tecnico 2',
            'email' => 'tecnico2@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1, // Barcelona
            'roles_id' => 4, // Tecnico
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*9*/   Usuario::create([
            'nombre' => 'Tecnico 3',
            'email' => 'tecnico3@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 2, // Berlin
            'roles_id' => 4, // Tecnico
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*10*/  Usuario::create([
            'nombre' => 'Tecnico 4',
            'email' => 'tecnico4@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 2, // Berlin
            'roles_id' => 4, // Tecnico
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*11*/  Usuario::create([
            'nombre' => 'Tecnico 5',
            'email' => 'tecnico5@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 3, // Montreal
            'roles_id' => 4, // Tecnico
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*12*/  Usuario::create([
            'nombre' => 'Tecnico 6',
            'email' => 'tecnico6@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 3, // Montreal
            'roles_id' => 4, // Tecnico
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*13*/  Usuario::create([
            'nombre' => 'Cliente 1',
            'email' => 'cliente1@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 1, // Barcelona
            'roles_id' => 1, // Cliente
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*14*/  Usuario::create([
            'nombre' => 'Cliente 2',
            'email' => 'cliente2@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 2, // Berlin
            'roles_id' => 1, // Cliente
            'created_at' => $now,
            'updated_at' => $now,
        ]);

/*15*/  Usuario::create([
            'nombre' => 'Cliente 3',
            'email' => 'cliente3@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'sedes_id' => 3, // Montreal
            'roles_id' => 1, // Cliente
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
    }
}

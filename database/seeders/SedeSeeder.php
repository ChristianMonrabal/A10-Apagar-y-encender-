<?php

namespace Database\Seeders;

use App\Models\Sede;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

/*1*/   Sede::create([
            'nombre' => 'Barcelona',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
/*2*/   Sede::create([
            'nombre' => 'Berlin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);   

/*3*/   Sede::create([
            'nombre' => 'Montreal',
            'created_at' => $now,
            'updated_at' => $now,
        ]);   
    }
}

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

        Sede::create([
            'nombre' => 'Barcelona',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Sede::create([
            'nombre' => 'Berlin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);   

        Sede::create([
            'nombre' => 'Montreal',
            'created_at' => $now,
            'updated_at' => $now,
        ]);   
    }
}

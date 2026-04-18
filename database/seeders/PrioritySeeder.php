<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('priorities')->insert([

            ['name'=>'PR-1 | Programado','description'=>'Prioridad media'],
            ['name'=>'PR-2 | En espera','description'=>'Prioridad baja'],
            ['name'=>'PR-3 | No programado','description'=>'Prioridad alta'],

        ]);
        //
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NewnessStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("state_newness")->insert([
            ["name"=>"NP | Novedades Pendientes"],
            ["name"=>"NR | Novedades Realizadas"],
        ]);
        //
    }
}

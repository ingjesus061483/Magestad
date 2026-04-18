<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeworkStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("state_homework")->insert([
            ["name"=>"TP | Tarea Pendiente"],
            ["name"=>"TR | Tarea Realizada"]
        ]);
        //
    }
}

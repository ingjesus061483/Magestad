<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class loanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loan_statuses')->insert([
            ['name'=>'Aprobado'],
            ['name'=>'Rechazado'],
            ['name'=>'En estudio']
        ]);
        //
    }
}

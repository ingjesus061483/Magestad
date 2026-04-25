<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CompanyPaymentDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_payment_dates')->insert([
            ['name'=>'Dia 5','description'=>''],
            [ 'name'=>'Dia 10','description'=>''],
            ['name'=>'Dia 20','description'=>''],
            [ 'name'=>'Dia 30','description'=>''],
            ['name'=>'Dia 5 | 20','description'=>''],
            ['name'=>'Dia 10 |25','description'=>''],
            ['name'=>'Dia 15 | 30','description'=>''],
            ['name'=>'semanal','description'=>''],

        ]);
        //
    }
}

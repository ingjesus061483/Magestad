<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerPaymentDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_payment_dates')->insert([
          ['name'=>'5','description'=>''],
          ['name'=>'10','description'=>''],
          ['name'=>'20','description'=>''],
          ['name'=>'30','description'=>''],
          ['name'=>'5 |20','description'=>''],
          ['name'=>'10 | 25','description'=>''],
          ['name'=>'15 | 30','description'=>''],
          ['name'=>'semanal','description'=>''],
        ]);
        //
    }
}

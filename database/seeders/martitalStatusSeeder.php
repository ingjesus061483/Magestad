<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MartitalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marital_status')->insert([
        ['name'=>'Casado','description'=>''],
        ['name'=>'Soltero','description'=>''],
        ['name'=>'Union libre','description'=>''],
        ['name'=>'Viudo','description'=>''],

    ]);
        //
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatePoliciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('state_policies')->insert([
            ['name'=> 'Acepto'],
            ['name'=>'No aepto'],
            ['name'=>'No entiendo'],
        ]);
        //
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EPSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eps=[
            ['name'=>'COMFAORIENTE'],
            ['name'=>'ALIANSALUD'],
            ['name'=>'NUEVA EPS'],
            ['name'=>'SALUD MIA'],
            ['name'=>'MUTUAL SER'],
            ['name'=>'MAGISTERIO'],
            [ 'name'=>'FAMISANAR'],
            ['name'=>'SANITAS'],
            ['name'=>'PROTEGER | ANTIGUO CAJACOPI'],
            [ 'name'=>'SALUD BOLIVAR' ],
            [ 'name'=>'COMPENSAR' ],
            [ 'name'=>'SURA'],
            ['name'=>'SAVIA SALUD'],
            ['name'=>'COMFENALCO'],
            ['name'=>'SALUD TOTAL'],
            ['name'=>'COOSALUD'],
            ['name'=>'CONSALUD'],
            [ 'name'=>'COOMEVA'],
            [ 'name'=>'CAPITAL SALUD'],
            [ 'name'=>'SALUD VIDA']
        ];
        DB::table('eps_affiliates')->insert($eps);
        //
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ARLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arls=[
          ["name"=>"AXA COLPATRIA"],
          ["name"=>"LIBERTY SEGUROS"],
          ["name"=>"POSITIVA"],
          ["name"=>"COLMENA"],
          ["name"=>"SURA"],
          ["name"=>"EQUIDAD SEGUROS"],
          [ "name"=>"MAPFRE"],
          ["name"=>"SEGUROS BOLIVAR"],
          ["name"=>"COLSANITAS"],
          ["name"=>"SEGUROS ALFA"],
          ["name"=>"AURORA | SEGUROS DE VIDA"],
        ];
        DB::table('arl_affiliates')->insert($arls);
        //
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['name'=> 'Antioquia','code'=> 5],
            ['name'=> 'Atlantico','code'=> 8],
            ['name'=> 'D. C. Santa Fe de Bogotá','code'=> 11],
            ['name'=> 'Bolivar','code'=> 13],
            ['name'=> 'Boyaca','code'=> 15],
            ['name'=> 'Caldas','code'=> 17],
            ['name'=> 'Caqueta','code'=> 18],
            ['name'=> 'Cauca','code'=> 19],
            ['name'=> 'Cesar','code'=> 20],
            ['name'=> 'Cordova','code'=> 23],
            ['name'=> 'Cundinamarca','code'=> 25],
            ['name'=> 'Choco','code'=> 27],
            ['name'=> 'Huila','code'=> 41],
            ['name'=> 'La Guajira','code'=> 44],
            ['name'=> 'Magdalena','code'=> 47],
            ['name'=> 'Meta', 'code'=>50],
            ['name'=> 'Nariño','code'=> 52],
            ['name'=> 'Norte de Santander','code'=> 54],
            ['name'=> 'Quindio','code'=> 63],
            ['name'=> 'Risaralda','code'=> 66],
            ['name'=> 'Santander','code'=> 68],
            ['name'=> 'Sucre','code'=> 70],
            ['name'=> 'Tolima','code'=> 73],
            ['name'=> 'Valle','code'=> 76],
            ['name'=> 'Arauca','code'=> 81],
            ['name'=> 'Casanare','code'=> 85],
            ['name'=> 'Putumayo','code'=> 86],
            ['name'=> 'San Andres','code'=> 88],
            ['name'=> 'Amazonas','code'=> 91],
            ['name'=> 'Guainia','code'=> 94],
            ['name'=> 'Guaviare','code'=> 95],
            ['name'=> 'Vaupes','code'=> 97],
            ['name'=> 'Vichada','code'=> 99]
        ]);
        //
    }
}

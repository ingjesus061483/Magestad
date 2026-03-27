<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewnessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("newness_types")->insert([
            ["name"=>"Acuerdo de pago"],
            ["name"=>"Avance legal"],
            ["name"=>"Base de datos"],
            ["name"=>"Calificacion cliente"],
            ["name"=>"Comentarios"],
            ["name"=>"Documentos devueltos"],
            ["name"=>"Documentos recibidos"],
            ["name"=>"Fechas de pago"],
            ["name"=>"Informacion | Aportes en linea"],
            ["name"=>"Informacion | ARL Riesgo laboral"],
            ["name"=>"Informacion | Camara de comercio RUES"],
            ["name"=>"Informacion | Camara de comercio UBICA"],
            ["name"=>"Informacion | EPS Fosyga Adres"],
            ["name"=>"Informacion | EPS UBICA"],
            ["name"=>"Informacion | FCC"],
            ["name"=>"Informacion | Google"],
            ["name"=>"Informacion | Operadores"],
            ["name"=>"Informacion | Rama judicial Procesos"],
            ["name"=>"Informacion | Redes sociales"],
            ["name"=>"Informacion | Registraduria"],
            ["name"=>"Informacion |SIMIT Transito"],
            ["name"=>"Informacion | SNR Oficina de registros"],
            ["name"=>"Master"],
            ["name"=>"Oficio de embargo"],
            ["name"=>"Propuesta de pago"],
        ]);
        //
    }
}

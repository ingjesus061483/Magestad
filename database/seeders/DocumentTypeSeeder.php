<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('document_types')->insert([
            ['name'=>'Cedula de ciudadania (ambos lados)'],
            ['name'=>'Certificado laboral no mayor a 30 dias'],
            ['name'=>'Desprendible de pago del ultimo mes'],
            ['name'=>'Extracto bancario utlimo mes'],
            ['name'=>'Carnet de empleado ambas caras'],
            ['name'=>'Carnet ARL ambas caras'],
            ['name'=>'Recibo de servicio publico'],
        ]);
        //
    }
}

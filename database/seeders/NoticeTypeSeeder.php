<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr=[
            ['name'=>'Avance legal'],
            ['name'=>'Solicitud de credito | Nueva '],
            ['name'=>'HBD | Hoy'],
            ['name'=>'Pagos | Hoy'],
            ['name'=>'Rubro en reclamación'],
            ['name'=>'Prestamos | Hoy'],
            ['name'=>'Recaudo | Hoy'],
            ['name'=>'Castigo cartera | Hoy'],
            ['name'=>'Plan separe | Vencimiento'],
            ['name'=>'Gasto provisional'],
            ['name'=>'PQRSF'],
            ['name'=>'Cobros | Stand bye'],
            ['name'=>'Pagos no contabilizados'],
            ['name'=>'Recordatorio citas | Hoy'],
            ['name'=>'Tareas pendientes'],
            ['name'=>'Novedades pendientes']
        ];
        DB::table('notice_types')->insert($arr);
        //
    }
}

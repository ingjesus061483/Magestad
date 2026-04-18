<?php
namespace App\Exports;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromArray;
class ClientExport implements FromArray
{
    protected $clients=[];
    protected $arr=[];
    public function __construct($clients)
    {
       $this->arr=
       [
            ["FECHA DE SOLICITUD",
            "REFERENCIA",
            "CALIDAD DEL TITULAR",
            "TITULO VALOR",
            "NOMBRES Y APELLIDOS",
            "IDENTIFICACION",
            "FECHA DE NACIMIENTO",
            "EDAD",
            "FECHA DE EXPEDICION",
            "DIRECCION",
            "BARRIO",
            'CIUDAD',
            "EMAIL",
            "ESTADO CIVIL",
            "INFORMACION DE CONTACTO",
            "NIT EMPRESA",
            "EMPRESA DONDE TRABAJA",
            "DIRECCION PRINCIPAL",
            "EMPRESA EN MISION",
            "NIT EMPRESA EN MISION",
            "DIRECCION SUCURSAL",
            "FECHA DE INGRESO",
            "SALARIO PROMEDIO MENSUAL",
            "CARGO ACTUAL",
            "FRECUENCIA DE PAGO",
            "FECHA DE PAGO EMPRESA",
            "FECHA DE PAGO CLIENTE ",
            "TIPO DE CONTRATO",
            "EPS","ARL",
            "NIVEL DE ESTUDIOS"
            ,"VEHICULO",
            "PROPIEDADES",
            "EMBARGO",
            "CREDITO SOLICITADO ($ Cop) ",
            "PLAZO (Meses)   ",
            "GARANTIA  ",
            "P1",
            "P2",
            "P3",
            "P4",
            "P5",
            "P6",
            "P7",
            "P8",
            "P9",
            "P10",
            "P11",
            "P12",
            "P13",
            "P14",
            "P15",
            "P16",
            "A1",
            "A2",
            "A3",
            "A4",
            "A5",
            "A6",
            "A7",
            "A8",
            "A9",
            "A10",
            "A11",
            "A12",
            "A13",
            "A14",
            "A15"]
        ];
        $this->clients=$clients;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        foreach($this->clients as $client)
        {
            $this->arr[]=[
                date("d/m/Y", strtotime($client->created_at)),
                $client->reference,
                $client->quality_holder,
                $client->value_Title,
                $client->name_last_name,
                $client->identification,
                date("d/m/Y", strtotime($client->date_birth)),
                $client->age.'años',
                date("d/m/Y", strtotime($client->expedition_date)),
                $client->address,
                $client->neighborhood,
                $client->city,
                    $client->email,
                $client->marital_status,
                $client->contact_informations,
                $client->nit,
                $client->Company_works,
                $client->main_address,
                $client->company_on_mission,
                $client->nit_company_mision,
                $client->branch_address,
                date("d/m/Y", strtotime($client->entry_date)),
                number_format( $client->average_monthly_salary),
                $client->current_position,
                $client->payment_frequency,
                $client->company_payment_date,
                $client->customer_payment,
                $client->contract_type,
                $client->eps_affiliate,
                $client->arl_affiliate,
                $client->level_study,
                ($client->vehicle? 'SI':'NO'),
                ($client->estate? 'SI':'NO'),
                ($client->seizure),
                number_format( $client->ammount),
                number_format($client->term).' meses',
                $client->warranty,
                $client->P1==1? 'Acepto':($client->P1==2? 'No acepto':($client->P1=='3'?'No entiendo':'')),
                $client->P2==1? 'Acepto':($client->P2==2? 'No acepto':($client->P2=='3'?'No entiendo':'')),
                $client->P3==1? 'Acepto':($client->P3==2? 'No acepto':($client->P3=='3'?'No entiendo':'')),
                $client->P4==1? 'Acepto':($client->P4==2? 'No acepto':($client->P4=='3'?'No entiendo':'')),
                $client->P5==1? 'Acepto':($client->P5==2? 'No acepto':($client->P5=='3'?'No entiendo':'')),
                $client->P6==1? 'Acepto':($client->P6==2? 'No acepto':($client->P6=='3'?'No entiendo':'')),
                $client->P7==1? 'Acepto':($client->P7==2? 'No acepto':($client->P7=='3'?'No entiendo':'')),
                $client->P8==1? 'Acepto':($client->P8==2? 'No acepto':($client->P8=='3'?'No entiendo':'')),
                $client->P9==1? 'Acepto':($client->P9==2? 'No acepto':($client->P9=='3'?'No entiendo':'')),
                $client->P10==1? 'Acepto':($client->P10==2? 'No acepto':($client->P10=='3'?'No entiendo':'')),
                $client->P11==1? 'Acepto':($client->P11==2? 'No acepto':($client->P11=='3'?'No entiendo':'')),
                $client->P12==1? 'Acepto':($client->P12==2? 'No acepto':($client->P12=='3'?'No entiendo':'')),
                $client->P13==1? 'Acepto':($client->P13==2? 'No acepto':($client->P13=='3'?'No entiendo':'')),
                $client->P14==1? 'Acepto':($client->P14==2? 'No acepto':($client->P14=='3'?'No entiendo':'')),
                $client->P15==1? 'Acepto':($client->P15==2? 'No acepto':($client->P15=='3'?'No entiendo':'')),
                $client->P16==1? 'Acepto':($client->P16==2? 'No acepto':($client->P16=='3'?'No entiendo':'')),
                $client->A1==1? 'Acepto':($client->A1==2? 'No acepto':($client->A1=='3'?'No entiendo':'')),
                $client->A2==1? 'Acepto':($client->A2==2? 'No acepto':($client->A2=='3'?'No entiendo':'')),
                $client->A3==1? 'Acepto':($client->A3==2? 'No acepto':($client->A3=='3'?'No entiendo':'')),
                $client->A4 ==1 ?'Acepto' : ( $client->A4 ==  2 ?  'No acepto' :($client->A4=='3'?'No entiendo':'') ) ,
                $client->A5 ==1 ?'Acepto' : ( $client->A5 ==  2 ?  'No acepto' :($client->A5=='3'?'No entiendo':'') ) ,
                $client->A6 ==1 ?'Acepto' : ( $client->A6 ==  2 ?  'No acepto' :($client->A6=='3'?'No entiendo':'') ) ,
                $client->A7 ==1 ?'Acepto' : ( $client->A7 ==  2 ?  'No acepto' :($client->A7=='3'?'No entiendo':'') ) ,
                $client->A8 ==1 ?'Acepto' : ( $client->A8 ==  2 ?  'No acepto' :($client->A8=='3'?'No entiendo':'') ) ,
                $client->A9 ==1 ?'Acepto' : ( $client->A9 ==  2 ?  'No acepto' :($client->A9=='3'?'No entiendo':'') ) ,
                $client->A10 ==1 ?'Acepto' : ( $client->A10 ==  2 ?  'No acepto' :( $client->A10=='3'? 'No entiendo':'' ) ),
                $client->A11 ==1 ?'Acepto' : ( $client->A11 ==  2 ?  'No acepto' :($client->A11=='3'?'No entiendo':'') ) ,
                $client->A12 ==1 ?'Acepto' : ( $client->A12 ==  2 ?  'No acepto' :($client->A12=='3'?'No entiendo':'') ),
                $client->A13 ==1 ?'Acepto' : ( $client->A13 ==  2 ?  'No acepto' :($client->A13=='3'?'No entiendo':'') ) ,
                $client->A14 ==1 ?'Acepto' : ( $client->A14 ==  2 ?  'No acepto' :($client->A14=='3'?'No entiendo':'') ) ,
                $client->A15 ==1 ?'Acepto' : ( $client->A15 ==  2 ?  'No acepto' :($client->A15=='3'?'No entiendo':'') )
            ];
        }
        return $this->arr;
    }
        /* */

}

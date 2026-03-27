@extends('Shared/layout')
@section('img',url('img/CerikSoluciones.png'))
@section('title','Formulario de solicitud de credito')
@section('content')
<div class="card mb-4" id="cardInfoPersonal"style=" width:85%;margin:0 auto;">
    <div class="card-header">
        <i class="fa-solid fa-id-card"></i>
        INFORMACION PERSONAL
    </div>
    <div class="card-body" style="font-size: 14px">
        @if(auth()->check())
        <div class="row">
            <div  class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for=""style="font-weight:bold"  > REFERENCIA: </label>
                    {{$client->reference}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for=""style="font-weight:bold"> CALIDAD DEL TITULAR: </label>
                    {{$client->quality_holder?->name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="" style="font-weight:bold">TITULO VALOR: </label>
                    {{$client->value_title}}
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="" style="font-weight:bold">NOMBRES Y APELLIDOS: </label>
                    {{$client->name_last_name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="" style="font-weight: bold"># DOCUMENTO:</label>
                    {{$client->identification}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3" >
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for="" style="font-weight: bold">FECHA DE NACIMIENTO:</label>
                                {{ date("d/m/Y", strtotime($client->date_birth))}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for="" style="font-weight:bold">EDAD:</label>
                                {{\Carbon\Carbon::parse($client->date_birth)->age.'años'}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3" >
                    <label class="form-label" for="" style="font-weight:bold">FECHA DE EXPEDICION:</label>
                    {{ date("d/m/Y", strtotime($client ->expedition_date))}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3" >
                    <label class="form-label" for="" style="font-weight: bold">DIRECCION RESIDENCIA:</label>
                    {{$client->address}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for=""style="font-weight:bold" >BARRIO: </label>
                    {{ $client->neighborhood}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3" >
                    <label class="form-label" for="" style="font-weight:bold"> ESTADO CIVIL:</label>
                    {{$client->marital_status->name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="" style="font-weight: bold"> EMAIL:</label>
                    {{$client->email}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3" >
                    <label class="form-label" for="" style="font-weight: bold"> NIVEL DE ESTUDIOS:</label>
                    {{$client->level_study->name}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4" id="cardDatosContacto" style="width:85%;margin:0 auto; ">
    <div class="card-header">
        <i class="fa-solid fa-address-book"></i>
        INFORMACION DE CONTACTO
    </div>
    <div class="card-body"  style="font-size: 14px">
        <ul>
            @foreach ($client->contact_informations as $item)
                <li style="list-style: none" ><strong>{{$item->phone_type->name}}:</strong>&nbsp;&nbsp;{{$item->phone_number}}</li>
            @endforeach
        </ul>
    </div>
</div>
<div class="card mb-4" id="cardInfoLaboral" style="width:85%;margin:0 auto; ">
    <div class="card-header">
        <i class="fa-solid fa-user-tie"></i>
        INFORMACION LABORAL
    </div>
    <div class="card-body" style="font-size:14px">
        @foreach($client->employment_informations as $item)
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        EMPRESA DONDE LABORA:
                    </label>
                    {{$item->company_works}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label"style="font-weight: bold" for="">
                        NIT #:
                    </label>
                    {{$item->nit_company_work}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        DIRECCION OFICINA PRINCIPAL:
                    </label>
                    {{$item->main_address}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        DEPARTAMENTO:
                    </label>
                    {{$item->state->name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label"style="font-weight: bold" for="">
                        CIUDAD:
                    </label>
                    {{$item->city->name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        EMPRESA EN MISION:
                    </label>
                    {{$item->company_on_mission}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        NIT EMPRESA EN MISION:
                    </label>
                    {{$item->nit}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        DIRECCION SEDE:
                    </label>
                    {{$item->branch_address}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        FECHA DE INGRESO:
                    </label>
                    {{ date("d/m/Y", strtotime($item->entry_date))}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        SALARIO MENSUAL PROMEDIO:
                    </label>
                    ${{number_format($item->monthly_average_salary,0,',','.')}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        CARGO ACTUAL:
                    </label>
                    {{$item->current_position}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        FRECUENCIA DE PAGOS:
                    </label>
                    {{$item->payment_frequency->name}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        FECHA DE PAGO EMPRESA (FPE):
                    </label>
                    {{$item->company_payment_date->name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        FECHA DE PAGO CLIENTE (FPC):
                    </label>
                    {{$item->customer_payment_date->name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        TIPO DE CONTRATO:
                    </label>
                    {{$item->contract_type->name}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        EPS AFILIADA:
                    </label>
                    {{$item->eps_affiliate->name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        ARL AFILIADA:
                    </label>
                    {{$item->arl_affiliate->name}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="card mb-4" id="cardInfoCrediticia" style="width:85%;margin:0 auto;">
    <div class="card-header">
        <i class="fa-solid fa-credit-card"></i>
        ACERCA EL CREDITO
    </div>
    <div class="card-body" style="font-size: 14px">
        @foreach($client->loans as $item)
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="" style="font-weight: bold">
                        CREDITO SOLICITADO (COP):
                    </label>
                   ${{number_format($item->ammount,0,',','.')}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        PLAZO SOLICITADO (Meses):
                    </label>
                    {{$item->term}}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3" >
                    <label class="form-label" style="font-weight: bold" for="">
                        TIPO DE GARANTIA:
                    </label>
                    {{$item->warranty->name}}
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
<div class="card mb-4" id="cardInfoPatrimonial" style="width:85%;margin:0 auto;">
    <div class="card-header">
        <i class="fa-solid fa-building-user"></i>
        INFORMACION PATRIMONIAL
    </div>
    <div class="card-body"style="font-size: 14px">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        POSEE VEHICULO:
                    </label>
                    {{$client->vehicle==1?'Si':'No' }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold" for="">
                        POSEE PROPIEDADES:
                    </label>
                    {{$client->estate==1?'Si':'No' }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4" id="cardInfoLegal" style="width:85%;margin:0 auto;">
    <div class="card-header">
        <i class="fa-solid fa-scale-balanced"></i>
        INFORMACION LEGAL
    </div>
    <div class="card-body" style="font-size: 14px">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="" style="font-weight: bold">
                        TIENE EMBARGOS
                    </label>
                    {{$client->seizure==1?'Si':'No' }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="" style="font-weight: bold">
                        EMPRESA QUE LO EMBARGA
                    </label>
                    {{$client->company_seizure}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4" id="cardPoltrataDatosPers" style="width:85%;margin:0 auto;">
    <div class="card-header">
        <i class="fa-solid fa-database"></i>
        POLITICA DE TRATAMIENTO DE DATOS PERSONALES
    </div>
    <div class="card-body">
        <p style="font-size:14px; text-align: justify; padding:5px">
            En cumplimiento de la Ley 1581 de 2012 y sus decretos reglamentarios, le informamos que los datos personales que nos ha suministrado serán incorporados en una base de datos de
            titularidad de Cerik Soluciones SAS, con el fin de dar cumplimiento a las obligaciones derivadas de la relación comercial que hemos establecido, así como para enviarle información
            relacionada con nuestros productos y servicios. Usted podrá ejercer sus derechos de acceso, rectificación, cancelación y oposición (ARCO) frente al tratamiento de sus datos personales,
            mediante comunicación escrita dirigida a nuestro correo electrónico:
        </p>
        <div  style="font-size:14px; text-align: justify; padding:5px">
            @if($client->acept_data_processing_policies)
            <i class="fa-solid fa-circle-check"></i>&nbsp; He leído y acepto la política de tratamiento de datos personales.
            @else
            <i class="fa-solid fa-circle-xmark"></i>&nbsp;No he aceptado la política de tratamiento de datos personales.'
            @endif
        </div>
    </div>
</div>
<div class="card mb-4" id="cardPolAutorizaciones"style="width:85%;margin:0 auto; ">
    <div class="card-header">
        <i class="fa-solid fa-building-shield"></i>
        POLITICAS Y AUTORIZACIONES
    </div>
    <div class="card-body"style="height:300px;overflow: auto;">
        @foreach ($client->client_policies as $item )
            <div style="margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
                <p style="font-size:14px; text-align: justify; padding:5px">
                    @switch($item->state_policy_id)
                        @case(1)
                            <i class="fa-solid fa-circle-check"></i>&nbsp;
                            <strong>{{$item->policy?->title}}</strong>&nbsp;|
                            &nbsp;{{$item->policy?->description}}
                            @break
                        @case(2)
                            <i class="fa-solid fa-circle-xmark"></i>&nbsp;
                            <strong> {{$item->policy?->title}}</strong>&nbsp;|
                            &nbsp;{{$item->policy?->description}}
                            @break
                        @case(3)
                            <i class="fa-solid fa-circle-question"></i>
                            &nbsp;<strong> {{$item->policy?->title}}</strong>&nbsp;|
                            &nbsp;{{$item->policy?->description}}
                            @break
                    @endswitch
                </p>
            </div>
        @endforeach
    </div>
</div>
<div class="card mb-4" id="cardPolAutorizaciones"style="width:85%;margin:0 auto; ">
    <div class="card-header">
        <i class="fa-solid fa-image"></i>
        DOCUMENTOS ADJUNTOS
    </div>
    <div class="card-body">
        <div style="padding: 5px ;font-size:14px; text-align: justify;">
           <p> Estimado Sr(a).&nbsp;&nbsp;<strong>{{$client->name_last_name}}</strong>:</p>
           <p>Para continuar con el proceso de su solicitud de crédito, es necesario que adjunte copia de los sgtes. documentos: </p>
        </div>
        <div style="width:100%; margin:0 auto">
            <table class="table table-bordered" style="  table-layout: fixed; width:100%" >
                <thead style ="font-size: 14px" >
                    <tr>
                        <th >&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th >&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th style="width:20px">#</th>
                        <th style="text-align:center;width:100%;">TIPO DE DOCUMENTO </th>
                        <th style="text-align:center;width:100%;" >CANTIDAD</th>

                    </tr>
                </thead>
                <tbody style ="font-size: 12px">
                    @foreach ($documenttypes as $item )
                        <tr>
                             <td style="text-align:center;">

                                <a title="adjuntar documentos" onclick="attach({{$item->id}})" class="btn btn-primary btn-sm" id="btnAttach" >
                                    <i class="fa-solid fa-paperclip"></i>
                                </a>
                            </td>
                            <td style="text-align:center;">
                                <form action="{{url('/documents')}}" method="GET">
                                    @csrf
                                    <input type="hidden" name="client_id" value="{{$client->id}}" >
                                    <input type="hidden" name="document_type_id" value="{{$item->id}}" >
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                </form>
                            </td>
                            <th scope="row" style="text-align: center;width:20px  ">{{$item->id}}.</th>
                            <td style="width:100%;">{{$item->name}}</td>
                            <td style="text-align:center;width:20px;">{{$item->amount}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

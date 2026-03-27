@extends('Shared/layout')
@section('title','Listado de clientes')
@section('content')

<div class="card mb-4" style="width: 70% ;margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Solicitudes de credito
    </div>
    <div class="card-body">
        <div style="padding: 5px">
            <a href="{{url('/clients/create')}}" title="Crear cliente" class="btn btn-primary" ><i class="fa-solid fa-user-tie"></i></a>
        </div>

        <table  class="table table-hover table-bordered" style="width:100%">
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="text-align:center">FECHA DE SOLICITUD </th>
                    <th style="text-align:center">REFERENCIA</th>
                    <th style="text-align:center">CALIDAD DEL TITULAR</th>
                    <th style="text-align:center">TITULO VALOR</th>
                    <th style="text-align:center">NOMBRES Y APELLIDOS</th>
                    <th style="text-align:center">IDENTIFICACION</th>
                    <th style="text-align:center">FECHA DE NACIMIENTO</th>
                    <th style="text-align:center">EDAD</th>
                    <th style="text-align:center">FECHA DE EXPEDICION</th>
                    <th style="text-align:center">DIRECCION</th>
                    <th style="text-align:center">EMAIL</th>
                    <th style="text-align:center"> BARRIO</th>
                    <th style="text-align:center">ESTADO CIVIL</th>
                    <th style="text-align:center">INFORMACION DE CONTACTO</th>
                    <th style="text-align:center">NIT EMPRESA</th>
                    <th style="text-align:center"> EMPRESA DONDE TRABAJA</th>
                    <th style="text-align:center">DIRECCION PRINCIPAL</th>
                    <th style="text-align:center"> EMPRESA EN MISION</th>
                    <th style="text-align:center"> NIT EMPRESA EN MISION</th>
                    <th style="text-align:center"> DIRECCION SUCURSAL</th>
                    <th style="text-align:center">FECHA DE INGRESO</th>
                    <th style="text-align:center">SALARIO PROMEDIO MENSUAL</th>
                    <th style="text-align:center"> CARGO ACTUAL</th>
                    <th style="text-align:center"> FRECUENCIA DE PAGO</th>
                    <th style="text-align:center">FECHA DE PAGO EMPRESA</th>
                    <th style="text-align:center"> FECHA DE PAGO CLIENTE </th>
                    <th style="text-align:center">TIPO DE CONTRATO</th>
                    <th style="text-align:center">EPS</th>
                    <th style="text-align:center">ARL   </th>
                    <th style="text-align:center">NIVEL DE ESTUDIOS  </th>
                    <tH style="text-align:center">VEHICULO  </th>
                    <th style="text-align:center">PROPIEDADES </th>
                    <th style="text-align:center">EMBARGO </th>
                    <th style="text-align:center">CREDITO SOLICITADO ($ Cop) </th>
                    <th style="text-align:center">PLAZO (Meses)   </th>
                    <th style="text-align:center">GARANTIA  </th>
                </tr>
            </thead>
            <tbody style ="font-size: 12px">
                @foreach ($clients as $item)
                <tr>
                    <td style="width:100%">
                        <form method="POST"  action="{{url('/clients')}}/{{$item->id}}"  style="display:inline">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="button" title="Eliminar" onclick="validar(this,'¿Desea eliminar el registro?')" class="btn btn-danger btn-sm" ><i class="fa-solid fa-trash"></i></button>
                        </form>

                    </td>
                    <td><a href="{{url('/clients')}}/{{$item->id}}/edit" title="Editar" class="btn btn-warning btn-sm"><i class="fa-solid fa-pencil"></i></a></td>
                    <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
                    <td>{{$item->reference}}</td>
                    <td>{{$item->quality_holders}}</td>
                    <td>{{$item->value_Title}}</td>
                    <td>{{$item->name_last_name}}</td>
                    <td>{{$item->identification}}</td>
                    <td>{{date("d/m/Y", strtotime($item->date_birth))}}</td>
                    <td>{{$item->age.' años'}}</td>
                    <td>{{date("d/m/Y", strtotime($item->expedition_date))}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->email}}</td>
                    <td> {{$item->neighborhood}}</td>
                    <td>{{$item->marital_status}}</td>
                    <td>{{$item->contact_informations}}</td>
                    <td>{{$item->nit}}</td>
                    <td>{{$item->Company_works}}</td>
                    <td>{{$item->main_address}}</td>
                    <td>{{$item->company_on_mission}}</td>
                    <td>{{$item->nit_company_mision}}</td>
                    <td>{{$item->branch_address}}</td>
                    <td>{{date("d/m/Y", strtotime($item->entry_date))}}</td>
                    <td>${{number_format($item->average_monthly_salary)}}</td>
                    <td>{{$item->current_position}}</td>
                    <td>{{$item->payment_frequency}}</td>
                    <td>{{$item->company_payment_date}}</td>
                    <td>{{$item->customer_payment}} </td>
                    <td>{{$item->contract_type}}</td>
                    <td>{{$item->eps_affiliate}}</td>
                    <td>{{$item->arl_affiliate}}</td>
                    <td>{{$item->level_study}}  </td>
                    <td>{{$item->vehicle==1?'Si':'No'}}  </td>
                    <td>{{$item->estate==1?'Si':'No'}}  </td>
                    <td>{{$item->seizure}} </td>
                    <td>${{number_format( $item->ammount)}}  </td>
                    <td>{{number_format($item->term)}}     </td>
                    <td>{{$item->warranty}}  </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

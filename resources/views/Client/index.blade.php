@extends('Shared/layout')
@section('title','Clientes')
@section('content')
<div class="card mb-4" style="margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Clientes
    </div>
    <div class="card-body">
        <div style="padding: 5px">
            <a href="{{url('/clients/create')}}" title="Crear cliente" class="btn btn-primary" >
                <i class="fa-solid fa-plus"></i>
            </a>
            <a title="Exportar a excel" href="{{url('clients/downloadExcel/0')}}" class="btn btn-success">
                <i class="fa-solid fa-file-excel"></i>
            </a>
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
                    <th style="text-align:center"> BARRIO</th>
                     <th style="text-align:center">CIUDAD</th>
                     <th style="text-align:center">EMAIL</th>
                    <th style="text-align:center">ESTADO CIVIL</th>
                    <th style="text-align:center">INFORMACION DE CONTACTO</th>
                    <th style="text-align:center">POSICION OCUPACIONAL</th>
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
                    <th style="text-align:center">TIPO DE CEDITO</th>
                    <th style="text-align:center">P1</th>
                    <th style="text-align:center">P2</th>
                    <th style="text-align:center">P3</th>
                    <th style="text-align:center">P4</th>
                    <th style="text-align:center">P5</th>
                    <th style="text-align:center">P6</th>
                    <th style="text-align:center">P7</th>
                    <th style="text-align:center">P8</th>
                    <th style="text-align:center">P9</th>
                    <th style="text-align:center">P10</th>
                    <th style="text-align:center">P11</th>
                    <th style="text-align:center">P12</th>
                    <th style="text-align:center">P13</th>
                    <th style="text-align:center">P14</th>
                    <th style="text-align:center">P15</th>
                    <th style="text-align:center">P16</th>
                    <th style="text-align:center">A1</th>
                    <th style="text-align:center">A2</th>
                    <th style="text-align:center">A3</th>
                    <th style="text-align:center">A4</th>
                    <th style="text-align:center">A5</th>
                    <th style="text-align:center">A6</th>
                    <th style="text-align:center">A7</th>
                    <th style="text-align:center">A8</th>
                    <th style="text-align:center">A9</th>
                    <th style="text-align:center">A10</th>
                    <th style="text-align:center">A11</th>
                    <th style="text-align:center">A12</th>
                    <th style="text-align:center">A13</th>
                    <th style="text-align:center">A14</th>
                    <th style="text-align:center">A15</th>
                </tr>
            </thead>
            <tbody style ="font-size: 12px">
                @foreach ($clients as $item)
                <tr>
                    <td>
                        <a href="{{url('/clients')}}/{{$item->id}}/edit"
                            title="Editar" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                    <td style="width:100%">
                        <form method="POST"  action="{{url('/clients')}}/{{$item->id}}"  style="display:inline">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="button" title="Eliminar" onclick="validar(this,'¿Desea eliminar el registro?')" class="btn btn-danger btn-sm" ><i class="fa-solid fa-trash"></i></button>
                        </form>

                    </td>
                    <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
                    <td>{{$item->reference}}</td>
                    <td>{{$item->quality_holder}}</td>
                    <td>{{$item->value_Title}}</td>
                    <td>{{$item->name_last_name}}</td>
                    <td>{{$item->identification}}</td>
                    <td>{{date("d/m/Y", strtotime($item->date_birth))}}</td>
                    <td>{{$item->age.' años'}}</td>
                    <td>{{date("d/m/Y", strtotime($item->expedition_date))}}</td>
                    <td>{{$item->address}}</td>
                    <td> {{$item->neighborhood}}</td>
                    <td>{{$item->city}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->marital_status}}</td>
                    <td>{{$item->contact_informations}}</td>
                    <TD>{{$item->occupational_position}}</TD>
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
                    <td>{{$item->loan_type}}</td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P1')">
                        @switch($item->P1)
                                @case(1)
                                    <i class="fa-solid fa-circle-check" style="color:green"></i>&nbsp;

                                    @break
                                @case(2)
                                    <i class="fa-solid fa-circle-xmark" style="color:red"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i class="fa-solid fa-circle-question" style="color:orange"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P2')">
                        @switch($item->P2)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;

                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P3')">
                        @switch($item->P3)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P4')">
                        @switch($item->P4)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P5')">
                        @switch($item->P5)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P6')">
                        @switch($item->P6)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P7')">
                        @switch($item->P7)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P8')">
                        @switch($item->P8)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P9')">
                        @switch($item->P9)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P10')">
                        @switch($item->P10)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P11')">
                        @switch($item->P11)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P12')">
                        @switch($item->P12)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P13')">
                        @switch($item->P13)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P14')">
                        @switch($item->P14)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P15')">
                        @switch($item->P15)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('P16')">
                        @switch($item->P16)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A1')">
                        @switch($item->A1)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;

                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A2')">
                        @switch($item->A2)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;

                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A3')">
                        @switch($item->A3)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A4')">
                        @switch($item->A4)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A5')">
                        @switch($item->A5)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A6')">
                        @switch($item->A6)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A7')">
                        @switch($item->A7)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A8')">
                         @switch($item->A8)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A9')">
                        @switch($item->A9)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A10')">
                        @switch($item->A10)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange"     class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A11')">
                         @switch($item->A11)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch

                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A12')">
                        @switch($item->A12)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A13')">
                        @switch($item->A13)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A14')">
                        @switch($item->A14)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                    <td style="text-align:center" onclick="GetPolicyBytitle('A15')">
                         @switch($item->A15)
                                @case(1)
                                    <i style="color: green" class="fa-solid fa-circle-check"></i>&nbsp;
                                    @break
                                @case(2)
                                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>&nbsp;
                                    @break
                                @case(3)
                                    <i style="color: orange" class="fa-solid fa-circle-question"></i>
                                    @break
                            @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection

@extends('Shared/layout')
@section('img',url('img/CerikSoluciones.png'))
@section('title','Formulario de solicitud de credito')
@section('content')
<style>
.acordion {
  background-color:rgb(0, 82, 94);
  color: hsl(0, 0%, 100%);
  border-radius:
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  border: white 1px solid;


}

.activo, .acordion:hover {
  background-color: #ccc;
  color: black
}

.panel {
    border: rgb(0, 82, 94) 1px solid;
  padding: 18px 18px 18px 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>
<div style="padding-bottom:5px">
    @if($client==null)
    <form action="{{url('/clients/0')}}" autocomplete="off" method="GET" autocapitalize="off" class=" d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input name="identification" class="form-control" type="text" placeholder="Digite su CC" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit "><i class="fas fa-search"></i></button>
        </div>
    </form>
    @else
    <a href="{{url('/clients')}}/{{$client->id}}" class="btn btn-primary ms-auto me-0 me-md-3 my-2 my-md-0">
        <i class="fa-solid fa-user-tie"></i>&nbsp;{{$client->name_last_name}}
    </a>
    @endif
</div>
<div id="accordion">
    <h3>
        <i class="fa-solid fa-id-card"></i>
        INFORMACION PERSONAL
    </h3>
    <div>
        <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                    Los campos marcados con * deben ser llenados obligatoriamente
                </div>
                <form autocomplete="off" action="{{url('/clients')}}{{$client!=null?'/'.$client->id:''}}" method="post" style="font-size: 14px"id="frmclient">
                    @csrf
                        <input type="hidden" name="id" value="{{$client?->id}}" id="id" >
                    @if($client!=null)
                        @method('PATCH')
                    @endif
                    @if(auth()->check())
                    <div class="row">
                        <div  class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for=""> REFERENCIA </label>
                                <input style="font-size: 12px" type="text" class="form-control"value="{{$client!=null?$client->reference: old('reference')}}"
                                    name="reference" id="reference">
                            </div>
                        </div>
                        <div  class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for=""> CALIDAD DEL TITULAR </label>
                                <select style="font-size: 12px" class="form-select" name="quality_holder" id="quality_holder">
                                <option value="">Seleccione una opción </option>
                                    @foreach($QualityHolder as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->quality_holder_id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for="">TITULO VALOR </label>
                                <input type="text" style="font-size: 12px" class="form-control" name ="value_Title" value="{{$client!=null?$client->value_Title:old('value_Title')}}" id="value_Title"/>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="" style="font-size:12px">NOMBRES Y APELLIDOS* </label>
                                <input type="text" style="font-size: 12px" class="form-control" name ="name_last_name" value="{{$client!=null?$client->name_last_name:old('name_last_name')}}" id="name_last_name"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="" style="font-size: 12px">#  DOCUMENTO*</label>
                                <input type="text" style="font-size: 12px" name="identification" id="identification" class="form-control" value="{{$client!=null?$client->identification:old('identification')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px" >FECHA DE NACIMIENTO*</label>
                                    <input type="date" style="font-size: 12px" name="birth_date" class="form-control" value="{{$client!=null?$client->date_birth:old('birth_date')}}"
                                            id="birth_date">
                            </div>
                            <div class="form-label"id="age" style="color:rgba(180, 158, 169, 1);font-size:10px">
                                EDAD:{{$client!=null? \Carbon\Carbon::parse($client->date_birth)->age:''}}
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px">FECHA DE EXPEDICION*</label>
                                <input type="date" style="font-size: 12px" name="expedition_date" class="form-control" value="{{$client!=null?
                                $client->expedition_date:old('expedition_date')}}"
                                id="expedition_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px">DIRECCION RESIDENCIA*</label>
                                <input type="text" style="font-size: 12px" class="form-control" value="{{$client!=null?$client->address:old('address')}}" name="address" id="address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for=""style="font-size: 12px">BARRIO* </label>
                                <input type="text" style="font-size: 12px" name="neighborhood" value="{{$client!=null?$client->neighborhood:old('neighborhood')}}" class="form-control" id="neighborhood">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                           <div class="col-sm-6">
                            <div class="mb-3" >
                            <label class="form-label" for=""style="font-size: 12px"> ESTADO CIVIL*</label>
                            <select name="marital_status" class="form-select" style="font-size: 12px" id="marital_status">
                            <option value="">Seleccione una opción </option>
                                    @foreach ($maritalstatus as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->marital_status_id?'selected':''}}{{$item->id==old('marital_status')?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for=""style="font-size: 12px"> EMAIL*</label>
                                <input type="email" value="{{$client!=null?$client->email:old('email')}}" style="font-size: 12px" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px"> NIVEL DE ESTUDIOS*</label>
                                <select name="study_level" class="form-select" style="font-size: 12px" id="study_level">
                                <option value="">Seleccione una opción </option>
                                    @foreach($studylevels as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->level_study_id?'selected':''}}{{$item->id==old('study_level')?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="btnGuardar" class="btn btn-success">{{$client==null?'Guardar':'Actualizar'}}</button>
                </form>
    </div>
    <h3>
        <i class="fa-solid fa-address-book"></i>
        INFORMACION DE CONTACTO
    </h3>
    <div>
        <a class="btn btn-primary"title="Crear datos de contacto" id="btnContact">
                <i class="fa-solid fa-square-phone-flip"></i>
            </a>
            <ul style="padding:0; margin-top:10px">
                @foreach($contactInfos as $item)
                <li style="list-style:none; padding-bottom:5px; display:flex; justify-content:space-between; align-items:center">
                    <strong>{{$item->phone_type->name}}: </strong>{{$item->phone_number}}
                    <form class="form form-inline" action="{{url('/contactinfo')}}/{{$item->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button title="Eliminar" class="btn btn-danger" type="button"
                            onclick="validar(this,'Desea eliminar este registro?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </li>
                @endforeach
            </ul>

    </div>
    <h3>
        <i class="fa-solid fa-user-tie"></i>
        INFORMACION LABORAL
    </h3>
    <div>
        <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
            Los campos marcados con * deben ser llenados obligatoriamente
        </div>
        <form autocomplete="off" action="{{url('/employmentInformations')}}{{$EmploymentInformation!=null?'/'.$EmploymentInformation->id:''}} "method="post" style="font-size: 14px">
                        @csrf
                        @if($EmploymentInformation!=null)
                            @method('PATCH')
                        @endif
                        <input type="hidden" name="client_id" value="{{$client!=null? $client->id:''}}" id="client_id" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA LABORA*
                                    </label>
                                    <input type="text"value="{{$EmploymentInformation!=null?$EmploymentInformation->company_works:old('company_works')}}" class="form-control" name="company_works" id="company_works" style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        NIT #*
                                    </label>
                                    <input type="text" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit_company_work:old('nit_company_works')}}" name="nit_company_works" id="nit_company_works"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DIRECCION OF. PPAL*
                                    </label>
                                    <input type="text" name="main_address" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->main_address:old('main_address')}}" id="main_address"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DEPARTAMENTO*
                                    </label>
                                    <select class="form-select" name="state" id="state"style="font-size: 12px">
                                        <option value="">Escoge un departamento </option>
                                        @foreach ($States as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->state_id?'selected':''}}{{old('state')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CIUDAD*
                                    </label>
                                    <select class="form-select" name="city" id="city"style="font-size: 12px">
                                        <option value="">Escoge una ciudad  </option>
                                        @foreach ($cities as $item)
                                        <option value ="{{$item->id}}"{{$item->id==$EmploymentInformation?->city_id?'selected':''}}{{old('city')!=''?'selected':''}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA EN MISION
                                    </label>
                                    <input type="text" name="company_on_mission" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->company_on_mission:old('company_on_mission')}}" id="company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        NIT EMPRESA MISION
                                    </label>
                                    <input class="form-control" type="text" name="nit_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit:old('nit_company_on_mission')}}" id="nit_company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DIRECCION SEDE
                                    </label>
                                    <input class="form-control" type="text" name="address_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->branch_address:old('address_company_on_mission')}}" id="address_company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE INGRESO*
                                    </label>
                                    <input type="date" name="entry_date" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->entry_date:old('entry_date')}}" id="entry_date"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">SALARIO MENSUAL*</label>
                                    <input type="text" class="currency form-control" name="average_monthly_salary" value="{{$EmploymentInformation!=null?'$'.number_format($EmploymentInformation->average_monthly_salary):old('average_monthly_salary')}}" id="average_monthly_salary"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CARGO ACTUAL*
                                    </label>
                                    <input type="text" class="form-control" name="current_position" value="{{$EmploymentInformation!=null?$EmploymentInformation->current_position:old('current_position')}}" id="current_position"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">FRECUENCIA PAGOS*</label>
                                    <select class="form-select" name="payment_frequency" id="payment_frequency"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($PaymentFrecuencies as $item)
                                        <option value="{{$item->id}}" {{$item->id==$EmploymentInformation?->payment_frequency_id?'selected':''}}{{old('payment_frequency')!=''?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE PAGO EMPRESA (FPE)*
                                    </label>
                                    <select class="form-select" name="company_payment_date" id="company_payment_date"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($CompanyPaymentDates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->company_payment_date_id?'selected':''}}{{old('company_payment_date')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE PAGO CLIENTE (FPC)*
                                    </label>
                                    <select class="form-select" name="custemer_payment_date" id="customer_payment_date"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($CustomerPaymentDates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->customer_payment_date_id?'selected':''}}{{old('custemer_payment_date')!=''?'selected':''}} >{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">TIPO DE CONTRATO*</label>
                                    <select class="form-select" name="contract_type" id="contract_type"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($ContractTypes as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->contract_type_id?'selected':''}}{{old('contract_type')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">EPS AFILIADA*</label>
                                    <select class="form-select" name="eps_affiliate" id="eps_affiliate"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($EpsAffiliates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->eps_affiliate_id?'selected':''}}{{old('eps_affiliate')!=''?'selected':''}} >{{$item->name}} </option>
                                        @endforeach
                                    </select>
                         <div style="font-size:12px">        <strong>Nota:</strong>   Si su  EPS no existe  en nuestra base de datos por favor creela  <a class="btnEps" href="#" id="btnEps"> aqui</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                 <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">ARL AFILIADA*</label>
                                    <select class="form-select" name="arl_affiliate" id="arl_affiliate"style="font-size: 12px">
                                        <option value="">Seleccione una opción </option>
                                        @foreach($ArlAffiliates as $item)
                                        <option value="{{$item->id}}" {{$item->id==$EmploymentInformation?->arl_affiliate_id?'selected':''}}{{old('arl_affiliate')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                    <div style="font-size:12px">  <strong>Nota:</strong> Si su ARL no existe  en nuestra base de datos por favor creela <a class="btnArl" href="#" id="btnArl">aqui</a></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btnGuardar" class="btn btn-success">{{$EmploymentInformation==null?'Guardar':'Actualizar'}}</button>
            </form>
    </div>
    <h3>
        <i class="fa-solid fa-wallet"></i>
        INFORMACION PATRIMONIAL
    </h3>
    <div>
        <form autocomplete="off" action="{{url('/clients/UpdatePatrimonialInformation')}}/{{$client!=null?$client->id:0}}"method="post" style="font-size:14px">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-sm-6 ">
                            <label class="form-check-label">
                                <input type="checkbox" {{$client?->vehicle==1?'checked':'' }} name="vehicle" id="vehicle">
                                POSEE VEHICULO
                            </label>
                        </div>
                        <div class="col-sm-6 " >
                            <label class="form-check-label" for="">
                                <input type="checkbox" name="estate" {{$client?->estate==1?'checked':'' }} id="estate">
                                POSEE PROPIEDADES
                            </label>
                        </div>
                        </div>
                        <div style="padding-top: 5px" >
                            <button type="submit" id="btnGuardar" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>

    </div>
    <h3>
         <i class="fa-solid fa-gavel"></i>
         INFORMACION LEGAL
    </h3>
    <div>
       <form autocomplete="off" action="{{url('/clients/UpdateLawInformation')}}/{{$client!=null?$client->id:0}}"method="post"style="font-size:14px">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-check form-check-inline" >
                                    <label class="form-check-label" for="">
                                        <input type="checkbox"  name="seizure" {{$client?->seizure==1?'checked':'' }} id="seizure">
                                        TIENE EMBARGOS
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-7" id="divCompanySeizure" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA QUE LO EMBARGA
                                    </label>
                                    <input type="text" class="form-control" style="font-size: 12px" value="{{$client?->company_seizure}}" name="company_seizure"  id="company_seizure">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" id="btnGuardar" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>

    </div>
    <h3>
        <i class="fa-solid fa-hand-holding-dollar"></i>
        ACERCA DEL CREDITO
    </h3>
    <div>
        <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                <h6>Los campos marcados con * deben ser llenados obligatoriamente </h6>
            </div>

                    <form autocomplete="off" action="{{url('/loans')}}{{$loan!=null?'/'.$loan->id:''}}"method="post" style="font-size:14px">
                        @if($loan!=null)
                            @method('PATCH')
                        @endif
                        @csrf
                        <input type="hidden" name="client_id"  value="{{$client!=null? $client->id:''}}" id="client_id" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CREDITO SOLICITADO (COP)*
                                    </label>
                                    <input class="currency form-control" type="text" name="ammount" value="{{$loan!=null?'$'.number_format($loan->ammount):old('ammount')}}" id="ammount" style="font-size:12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        PLAZO SOLICITADO (Meses)*
                                    </label>
                                    <input class="form-control" type="number" name="term" value="{{$loan!=null?$loan->term:old('term')}}" id="term" style="font-size:12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3" >
                                    <label class="form-label" for="">
                                        TIPO DE GARANTIA*
                                    </label>
                                    <select class="form-select" name="warranty" id="warranty" style="font-size:12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($Warranties as $item)
                                        <option value="{{$item->id}}"{{$item->id==$loan?->warranty_id?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btnGuardar" class="btn btn-success">{{$loan==null?'Guardar':'Actualizar'}}</button>
                    </form>
    </div>
     <h3>
        <i class="fa-solid fa-shield-halved"></i>
        TRATAMIENTO DE DATOS PERSONALES
     </h3>
    <div>
        <form action="{{url('/clients/UpdateDataProccess')}}/{{$client?->id}}"method="post" autocomplete="off">
            @method('patch')
            @csrf
            <iframe src="{{url('Politicas/Politicadedatos.pdf')}}" style="width:100%; height:500px;" frameborder="0"></iframe>
            <div style="padding: 5px; font-size:14px">
                <input type="checkbox" name="accept_data_treatment" id="accept_data_treatment"
                {{$client!=null&&$client->acept_data_processing_policies?'checked':''}}>
                <label for="accept_data_treatment">
                    Acepto la politica de tratamiento de datos personales
                </label>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
      <h3>
          <i class="fa-solid fa-building-shield"></i>
          POLITICAS Y AUTORIZACIONES
      </h3>
    <div>
        <div>
            <ul style="font-size:10px">
                <li style="list-style:none;font-weight:bold; color: green"><i class="fa-solid fa-circle-check"></i> Si acepto </li>
                <li style="list-style:none;font-weight:bold; color: red"><i class="fa-solid fa-circle-xmark"></i>  No acepto</li>
                <li style="list-style:none;font-weight:bold; color:orange"><i class="fa-solid fa-circle-question"></i> No entiendo</li>
            </ul>
        </div>
        @if(count($policies)>0)
        <div class="card mb-4" style="width:100%;margin:0 auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5);">
            <div class="card-header">
                POLITICAS
            </div>
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($policies as $item)
                    <div style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
                        <form id="frmClientPolicy" action="{{url('/clientPolicies')}}" method="post">
                            @csrf
                            <input type="hidden"name="client_id" value="{{$client?->id}}" id="client_id">
                            <input type="hidden" name="state_policy_id" id="state_policy_id">
                            <input type="hidden"name="policy_id" value="{{$item->id}}" id="policy_id">
                            <p style="font-size:14px; text-align: justify; padding:5px">
                            <strong> {{$item->title}}</strong>&nbsp;|&nbsp;{{$item->description}}
                            </p>
                            <div class="row" style="padding:5px">
                                <div class="col-4">
                                    <button type="button" title="Si Acepto" onclick="submitPolicy(1)" style="width:100%; " class="btn btn-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;" onclick="submitPolicy(2)">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button"title ="No entiendo" class="btn btn-warning"style="width:100%; " onclick="submitPolicy(3)">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        @endif
        @if(count($autorizations)>0)
        <div class="card mb-4" style="width:100%;margin:10px auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5); ">
            <div class="card-header">
                AUTORIZACIONES
            </div>
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($autorizations as $item)
                <div style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
                    <form id="frmClientPolicy" action="{{url('/clientPolicies')}}" method="post">
                        @csrf
                        <input type="hidden"name="client_id" value="{{$client?->id}}" id="client_id">
                        <input type="hidden" name="state_policy_id" id="state_policy_id">
                        <input type="hidden"name="policy_id" value="{{$item->id}}" id="policy_id">
                        <p style="font-size:14px; text-align: justify; padding:5px">
                        <strong> {{$item->title}}</strong>&nbsp;|&nbsp;{{$item->description}}
                        </p>
                        <div class="row" style="padding:5px">
                            <div class="col-4">
                                <button type="button" title="Si Acepto" onclick="submitPolicy(1)" style="width:100%; " class="btn btn-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;" onclick="submitPolicy(2)">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button"title ="No entiendo" class="btn btn-warning"style="width:100%; " onclick="submitPolicy(3)">
                                    <i class="fa-solid fa-circle-question"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
                </div>
          </div>
        </div>
        @endif
        @if(count($policyclients)>0 && count($policies)==0 && count($autorizations)==0)
        <div style="width:100%;margin:0 auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5);">
            <div class="card-header">
                &nbsp;
            </div>
            <div class="card-body">
                <div style="height:300px; overflow: auto;">
                    @foreach ($policyclients as $item )
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
        </div>
        @endif

    </div>
</div>


<!--<button class="acordion">
    <i class="fa-solid fa-id-card"></i>
    INFORMACION PERSONAL
</button>
<div class="panel">
   <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                    Los campos marcados con * deben ser llenados obligatoriamente
                </div>
                <form autocomplete="off" action="{{url('/clients')}}{{$client!=null?'/'.$client->id:''}}" method="post" style="font-size: 14px"id="frmclient">
                    @csrf
                        <input type="hidden" name="id" value="{{$client?->id}}" id="id" >
                    @if($client!=null)
                        @method('PATCH')
                    @endif
                    @if(auth()->check())
                    <div class="row">
                        <div  class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for=""> REFERENCIA </label>
                                <input style="font-size: 12px" type="text" class="form-control"value="{{$client!=null?$client->reference: old('reference')}}"
                                    name="reference" id="reference">
                            </div>
                        </div>
                        <div  class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for=""> CALIDAD DEL TITULAR </label>
                                <select style="font-size: 12px" class="form-select" name="quality_holder" id="quality_holder">
                                <option value="">Seleccione una opción </option>
                                    @foreach($QualityHolder as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->quality_holder_id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for="">TITULO VALOR </label>
                                <input type="text" style="font-size: 12px" class="form-control" name ="value_Title" value="{{$client!=null?$client->value_Title:old('value_Title')}}" id="value_Title"/>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="" style="font-size:12px">NOMBRES Y APELLIDOS* </label>
                                <input type="text" style="font-size: 12px" class="form-control" name ="name_last_name" value="{{$client!=null?$client->name_last_name:old('name_last_name')}}" id="name_last_name"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="" style="font-size: 12px">#  DOCUMENTO*</label>
                                <input type="text" style="font-size: 12px" name="identification" id="identification" class="form-control" value="{{$client!=null?$client->identification:old('identification')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px" >FECHA DE NACIMIENTO*</label>
                                    <input type="date" style="font-size: 12px" name="birth_date" class="form-control" value="{{$client!=null?$client->date_birth:old('birth_date')}}"
                                            id="birth_date">
                            </div>
                            <div class="form-label"id="age" style="color:rgba(180, 158, 169, 1);font-size:10px">
                                EDAD:{{$client!=null? \Carbon\Carbon::parse($client->date_birth)->age:''}}
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px">FECHA DE EXPEDICION*</label>
                                <input type="date" style="font-size: 12px" name="expedition_date" class="form-control" value="{{$client!=null?
                                $client->expedition_date:old('expedition_date')}}"
                                id="expedition_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px">DIRECCION RESIDENCIA*</label>
                                <input type="text" style="font-size: 12px" class="form-control" value="{{$client!=null?$client->address:old('address')}}" name="address" id="address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for=""style="font-size: 12px">BARRIO* </label>
                                <input type="text" style="font-size: 12px" name="neighborhood" value="{{$client!=null?$client->neighborhood:old('neighborhood')}}" class="form-control" id="neighborhood">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                           <div class="col-sm-6">
                            <div class="mb-3" >
                            <label class="form-label" for=""style="font-size: 12px"> ESTADO CIVIL*</label>
                            <select name="marital_status" class="form-select" style="font-size: 12px" id="marital_status">
                            <option value="">Seleccione una opción </option>
                                    @foreach ($maritalstatus as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->marital_status_id?'selected':''}}{{$item->id==old('marital_status')?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for=""style="font-size: 12px"> EMAIL*</label>
                                <input type="email" value="{{$client!=null?$client->email:old('email')}}" style="font-size: 12px" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px"> NIVEL DE ESTUDIOS*</label>
                                <select name="study_level" class="form-select" style="font-size: 12px" id="study_level">
                                <option value="">Seleccione una opción </option>
                                    @foreach($studylevels as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->level_study_id?'selected':''}}{{$item->id==old('study_level')?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="btnGuardar" class="btn btn-success">{{$client==null?'Guardar':'Actualizar'}}</button>
                </form>
</div>
<button class="acordion">
    <i class="fa-solid fa-address-book"></i>
    INFORMACION DE CONTACTO
</button>
<div class="panel">
  <a class="btn btn-primary"title="Crear datos de contacto" id="btnContact">
                <i class="fa-solid fa-square-phone-flip"></i>
            </a>
            <ul style="padding:0; margin-top:10px">
                @foreach($contactInfos as $item)
                <li style="list-style:none; padding-bottom:5px; display:flex; justify-content:space-between; align-items:center">
                    <strong>{{$item->phone_type->name}}: </strong>{{$item->phone_number}}
                    <form class="form form-inline" action="{{url('/contactinfo')}}/{{$item->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button title="Eliminar" class="btn btn-danger" type="button"
                            onclick="validar(this,'Desea eliminar este registro?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </li>
                @endforeach
            </ul>
</div>
<button class="acordion">
          <i class="fa-solid fa-user-tie"></i>
            INFORMACION LABORAL
</button>
<div class="panel">
   <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                Los campos marcados con * deben ser llenados obligatoriamente
            </div>
             <form autocomplete="off" action="{{url('/employmentInformations')}}{{$EmploymentInformation!=null?'/'.$EmploymentInformation->id:''}} "method="post" style="font-size: 14px">
                        @csrf
                        @if($EmploymentInformation!=null)
                            @method('PATCH')
                        @endif
                        <input type="hidden" name="client_id" value="{{$client!=null? $client->id:''}}" id="client_id" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA LABORA*
                                    </label>
                                    <input type="text"value="{{$EmploymentInformation!=null?$EmploymentInformation->company_works:old('company_works')}}" class="form-control" name="company_works" id="company_works" style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        NIT #*
                                    </label>
                                    <input type="text" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit_company_work:old('nit_company_works')}}" name="nit_company_works" id="nit_company_works"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DIRECCION OF. PPAL*
                                    </label>
                                    <input type="text" name="main_address" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->main_address:old('main_address')}}" id="main_address"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DEPARTAMENTO*
                                    </label>
                                    <select class="form-select" name="state" id="state"style="font-size: 12px">
                                        <option value="">Escoge un departamento </option>
                                        @foreach ($States as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->state_id?'selected':''}}{{old('state')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CIUDAD*
                                    </label>
                                    <select class="form-select" name="city" id="city"style="font-size: 12px">
                                        <option value="">Escoge una ciudad  </option>
                                        @foreach ($cities as $item)
                                        <option value ="{{$item->id}}"{{$item->id==$EmploymentInformation?->city_id?'selected':''}}{{old('city')!=''?'selected':''}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA EN MISION
                                    </label>
                                    <input type="text" name="company_on_mission" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->company_on_mission:old('company_on_mission')}}" id="company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        NIT EMPRESA MISION
                                    </label>
                                    <input class="form-control" type="text" name="nit_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit:old('nit_company_on_mission')}}" id="nit_company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DIRECCION SEDE
                                    </label>
                                    <input class="form-control" type="text" name="address_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->branch_address:old('address_company_on_mission')}}" id="address_company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE INGRESO*
                                    </label>
                                    <input type="date" name="entry_date" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->entry_date:old('entry_date')}}" id="entry_date"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">SALARIO MENSUAL*</label>
                                    <input type="text" class="currency form-control" name="average_monthly_salary" value="{{$EmploymentInformation!=null?'$'.number_format($EmploymentInformation->average_monthly_salary):old('average_monthly_salary')}}" id="average_monthly_salary"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CARGO ACTUAL*
                                    </label>
                                    <input type="text" class="form-control" name="current_position" value="{{$EmploymentInformation!=null?$EmploymentInformation->current_position:old('current_position')}}" id="current_position"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">FRECUENCIA PAGOS*</label>
                                    <select class="form-select" name="payment_frequency" id="payment_frequency"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($PaymentFrecuencies as $item)
                                        <option value="{{$item->id}}" {{$item->id==$EmploymentInformation?->payment_frequency_id?'selected':''}}{{old('payment_frequency')!=''?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE PAGO EMPRESA (FPE)*
                                    </label>
                                    <select class="form-select" name="company_payment_date" id="company_payment_date"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($CompanyPaymentDates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->company_payment_date_id?'selected':''}}{{old('company_payment_date')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE PAGO CLIENTE (FPC)*
                                    </label>
                                    <select class="form-select" name="custemer_payment_date" id="customer_payment_date"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($CustomerPaymentDates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->customer_payment_date_id?'selected':''}}{{old('custemer_payment_date')!=''?'selected':''}} >{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">TIPO DE CONTRATO*</label>
                                    <select class="form-select" name="contract_type" id="contract_type"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($ContractTypes as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->contract_type_id?'selected':''}}{{old('contract_type')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">EPS AFILIADA*</label>
                                    <select class="form-select" name="eps_affiliate" id="eps_affiliate"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($EpsAffiliates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->eps_affiliate_id?'selected':''}}{{old('eps_affiliate')!=''?'selected':''}} >{{$item->name}} </option>
                                        @endforeach
                                    </select>
                         <div style="font-size:12px">        <strong>Nota:</strong>   Si su  EPS no existe  en nuestra base de datos por favor creela  <a class="btnEps" href="#" id="btnEps"> aqui</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                 <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">ARL AFILIADA*</label>
                                    <select class="form-select" name="arl_affiliate" id="arl_affiliate"style="font-size: 12px">
                                        <option value="">Seleccione una opción </option>
                                        @foreach($ArlAffiliates as $item)
                                        <option value="{{$item->id}}" {{$item->id==$EmploymentInformation?->arl_affiliate_id?'selected':''}}{{old('arl_affiliate')!=''?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                    <div style="font-size:12px">  <strong>Nota:</strong> Si su ARL no existe  en nuestra base de datos por favor creela <a class="btnArl" href="#" id="btnArl">aqui</a></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btnGuardar" class="btn btn-success">{{$EmploymentInformation==null?'Guardar':'Actualizar'}}</button>
            </form>

</div>
<button class="acordion">
    <i class="fa-solid fa-wallet"></i>
    INFORMACION PATRIMONIAL
</button>
<div class="panel">
      <form autocomplete="off" action="{{url('/clients/UpdatePatrimonialInformation')}}/{{$client!=null?$client->id:0}}"method="post" style="font-size:14px">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-sm-6 ">
                            <label class="form-check-label">
                                <input type="checkbox" {{$client?->vehicle==1?'checked':'' }} name="vehicle" id="vehicle">
                                POSEE VEHICULO
                            </label>
                        </div>
                        <div class="col-sm-6 " >
                            <label class="form-check-label" for="">
                                <input type="checkbox" name="estate" {{$client?->estate==1?'checked':'' }} id="estate">
                                POSEE PROPIEDADES
                            </label>
                        </div>
                        </div>
                        <div style="padding-top: 5px" >
                            <button type="submit" id="btnGuardar" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>

</div>
<button class="acordion">
    <i class="fa-solid fa-gavel"></i>
    INFORMACION LEGAL
</button>
<div class="panel">
    <form autocomplete="off" action="{{url('/clients/UpdateLawInformation')}}/{{$client!=null?$client->id:0}}"method="post"style="font-size:14px">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-check form-check-inline" >
                                    <label class="form-check-label" for="">
                                        <input type="checkbox"  name="seizure" {{$client?->seizure==1?'checked':'' }} id="seizure">
                                        TIENE EMBARGOS
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-7" id="divCompanySeizure" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA QUE LO EMBARGA
                                    </label>
                                    <input type="text" class="form-control" style="font-size: 12px" value="{{$client?->company_seizure}}" name="company_seizure"  id="company_seizure">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" id="btnGuardar" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>

</div>
<button class="acordion">
    <i class="fa-solid fa-hand-holding-dollar"></i>
    ACERCA DEL CREDITO
</button>
<div class="panel">
    <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                <h6>Los campos marcados con * deben ser llenados obligatoriamente </h6>
            </div>

                    <form autocomplete="off" action="{{url('/loans')}}{{$loan!=null?'/'.$loan->id:''}}"method="post" style="font-size:14px">
                        @if($loan!=null)
                            @method('PATCH')
                        @endif
                        @csrf
                        <input type="hidden" name="client_id"  value="{{$client!=null? $client->id:''}}" id="client_id" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CREDITO SOLICITADO (COP)*
                                    </label>
                                    <input class="currency form-control" type="text" name="ammount" value="{{$loan!=null?'$'.number_format($loan->ammount):old('ammount')}}" id="ammount" style="font-size:12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        PLAZO SOLICITADO (Meses)*
                                    </label>
                                    <input class="form-control" type="number" name="term" value="{{$loan!=null?$loan->term:old('term')}}" id="term" style="font-size:12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3" >
                                    <label class="form-label" for="">
                                        TIPO DE GARANTIA*
                                    </label>
                                    <select class="form-select" name="warranty" id="warranty" style="font-size:12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($Warranties as $item)
                                        <option value="{{$item->id}}"{{$item->id==$loan?->warranty_id?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btnGuardar" class="btn btn-success">{{$loan==null?'Guardar':'Actualizar'}}</button>
                    </form>
</div>
<button class="acordion">
    <i class="fa-solid fa-shield-halved"></i>
    TRATAMIENTO DE DATOS PERSONALES
</button>
<div class="panel">
        <form action="{{url('/clients/UpdateDataProccess')}}/{{$client?->id}}"method="post" autocomplete="off">
            @method('patch')
            @csrf
            <iframe src="{{url('Politicas/Politicadedatos.pdf')}}" style="width:100%; height:500px;" frameborder="0"></iframe>
            <div style="padding: 5px; font-size:14px">
                <input type="checkbox" name="accept_data_treatment" id="accept_data_treatment"
                {{$client!=null&&$client->acept_data_processing_policies?'checked':''}}>
                <label for="accept_data_treatment">
                    Acepto la politica de tratamiento de datos personales
                </label>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
</div>
<button class="acordion">
    <i class="fa-solid fa-building-shield"></i>
    POLITICAS Y AUTORIZACIONES
</button>
<div class="panel">
    <div>
            <ul style="font-size:10px">
                <li style="list-style:none;font-weight:bold; color: green"><i class="fa-solid fa-circle-check"></i> Si acepto </li>
                <li style="list-style:none;font-weight:bold; color: red"><i class="fa-solid fa-circle-xmark"></i>  No acepto</li>
                <li style="list-style:none;font-weight:bold; color:orange"><i class="fa-solid fa-circle-question"></i> No entiendo</li>
            </ul>
        </div>
        @if(count($policies)>0)
        <div class="card mb-4" style="width:100%;margin:0 auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5);">
            <div class="card-header">
                POLITICAS
            </div>
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($policies as $item)
                    <div style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
                        <form id="frmClientPolicy" action="{{url('/clientPolicies')}}" method="post">
                            @csrf
                            <input type="hidden"name="client_id" value="{{$client?->id}}" id="client_id">
                            <input type="hidden" name="state_policy_id" id="state_policy_id">
                            <input type="hidden"name="policy_id" value="{{$item->id}}" id="policy_id">
                            <p style="font-size:14px; text-align: justify; padding:5px">
                            <strong> {{$item->title}}</strong>&nbsp;|&nbsp;{{$item->description}}
                            </p>
                            <div class="row" style="padding:5px">
                                <div class="col-4">
                                    <button type="button" title="Si Acepto" onclick="submitPolicy(1)" style="width:100%; " class="btn btn-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;" onclick="submitPolicy(2)">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button"title ="No entiendo" class="btn btn-warning"style="width:100%; " onclick="submitPolicy(3)">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        @endif
        @if(count($autorizations)>0)
        <div class="card mb-4" style="width:100%;margin:10px auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5); ">
            <div class="card-header">
                AUTORIZACIONES
            </div>
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($autorizations as $item)
                <div style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
                    <form id="frmClientPolicy" action="{{url('/clientPolicies')}}" method="post">
                        @csrf
                        <input type="hidden"name="client_id" value="{{$client?->id}}" id="client_id">
                        <input type="hidden" name="state_policy_id" id="state_policy_id">
                        <input type="hidden"name="policy_id" value="{{$item->id}}" id="policy_id">
                        <p style="font-size:14px; text-align: justify; padding:5px">
                        <strong> {{$item->title}}</strong>&nbsp;|&nbsp;{{$item->description}}
                        </p>
                        <div class="row" style="padding:5px">
                            <div class="col-4">
                                <button type="button" title="Si Acepto" onclick="submitPolicy(1)" style="width:100%; " class="btn btn-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;" onclick="submitPolicy(2)">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button"title ="No entiendo" class="btn btn-warning"style="width:100%; " onclick="submitPolicy(3)">
                                    <i class="fa-solid fa-circle-question"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
                </div>
          </div>
        </div>
        @endif
        @if(count($policyclients)>0 && count($policies)==0 && count($autorizations)==0)
        <div style="width:100%;margin:0 auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5);">
            <div class="card-header">
                &nbsp;
            </div>
            <div class="card-body">
                <div style="height:300px; overflow: auto;">
                    @foreach ($policyclients as $item )
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
        </div>
        @endif

</div>



<div style="padding:5px;" >
    <div class="row" style="margin-top:5px">
        <div class="col-sm-4" style="margin-top: 5px" >
            <a id="btnInfoPersonal" style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='client'?'btn btn-info':'btn btn-primary'}}" >Información personal</a>
        </div>
        <div class="col-sm-4" style="margin-top: 5px">
            <a id="btnDatosContacto"style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='contact'?'btn btn-info':'btn btn-primary'}}">Información de contacto</a>
        </div>
        <div class="col-sm-4" style="margin-top: 5px">
            <a id="btnInfoLaboral"style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='employment'?'btn btn-info':'btn btn-primary'}}">Información laboral</a>
        </div>
    </div>
    <div class ="row" style="margin-top:5px">
        <div class="col-sm-4" style="margin-top: 5px">
            <a id="btnInfoPatrimonial"style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='patrimonial'?'btn btn-info':'btn btn-primary'}}">Información patrimonial</a>
        </div>
        <div class="col-sm-4" style="margin-top: 5px">
            <a id="btnInfoLegal"style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='law'?'btn btn-info':'btn btn-primary'}}">Información Legal </a>
        </div>
        <div class="col-sm-4" style="margin-top: 5px">
            <a id="btnInfoCredito"style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='loan'?'btn btn-info':'btn btn-primary'}}">Acerca del crédito   </a>
        </div>
    </div>
    <div class="row" style="margin-top:5px">
        <div class="col-sm-4" style="margin-top: 5px">
            <a id="btnPoltrataDatosPers"style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='PersonData'?'btn btn-info':'btn btn-primary'}}">Tratamiento de datos </a>
        </div>
        <div class="col-sm-4" style="margin-top: 5px">
            <a id="btnPolAutorizaciones"style="width:100%;height:50px;font-size:12px;font-weight:bold;padding:5px" class="{{$info=='AuthorizeProtocol'?'btn btn-info':'btn btn-primary'}}">Políticas y Autorizaciones</a>
        </div>
    </div>
</div>
<div class="card mb-4" id="cardPolAutorizaciones"style="width:100%;margin:0 auto; display:none;">
    <div class="card-header">
        <i class="fa-solid fa-building-shield"></i>
        POLITICAS Y AUTORIZACIONES
    </div>
    <div class="card-body">
        <div>
            <ul style="font-size:10px">
                <li style="list-style:none;font-weight:bold; color: green"><i class="fa-solid fa-circle-check"></i> Si acepto </li>
                <li style="list-style:none;font-weight:bold; color: red"><i class="fa-solid fa-circle-xmark"></i>  No acepto</li>
                <li style="list-style:none;font-weight:bold; color:orange"><i class="fa-solid fa-circle-question"></i> No entiendo</li>
            </ul>
        </div>
        @if(count($policies)>0)
        <div style="width:100%;margin:0 auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5);">
            <div class="card-header">
                POLITICAS
            </div>
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($policies as $item)
                    <div style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
                        <form id="frmClientPolicy" action="{{url('/clientPolicies')}}" method="post">
                            @csrf
                            <input type="hidden"name="client_id" value="{{$client?->id}}" id="client_id">
                            <input type="hidden" name="state_policy_id" id="state_policy_id">
                            <input type="hidden"name="policy_id" value="{{$item->id}}" id="policy_id">
                            <p style="font-size:14px; text-align: justify; padding:5px">
                            <strong> {{$item->title}}</strong>&nbsp;|&nbsp;{{$item->description}}
                            </p>
                            <div class="row" style="padding:5px">
                                <div class="col-4">
                                    <button type="button" title="Si Acepto" onclick="submitPolicy(1)" style="width:100%; " class="btn btn-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;" onclick="submitPolicy(2)">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button"title ="No entiendo" class="btn btn-warning"style="width:100%; " onclick="submitPolicy(3)">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        @endif
        @if(count($autorizations)>0)
        <div  style="width:100%;margin:10px auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5); ">
            <div class="card-header">
                AUTORIZACIONES
            </div>
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($autorizations as $item)
                <div style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
                    <form id="frmClientPolicy" action="{{url('/clientPolicies')}}" method="post">
                        @csrf
                        <input type="hidden"name="client_id" value="{{$client?->id}}" id="client_id">
                        <input type="hidden" name="state_policy_id" id="state_policy_id">
                        <input type="hidden"name="policy_id" value="{{$item->id}}" id="policy_id">
                        <p style="font-size:14px; text-align: justify; padding:5px">
                        <strong> {{$item->title}}</strong>&nbsp;|&nbsp;{{$item->description}}
                        </p>
                        <div class="row" style="padding:5px">
                            <div class="col-4">
                                <button type="button" title="Si Acepto" onclick="submitPolicy(1)" style="width:100%; " class="btn btn-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;" onclick="submitPolicy(2)">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button"title ="No entiendo" class="btn btn-warning"style="width:100%; " onclick="submitPolicy(3)">
                                    <i class="fa-solid fa-circle-question"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
                </div>
          </div>
        </div>
        @endif
        @if(count($policyclients)>0 && count($policies)==0 && count($autorizations)==0)
        <div style="width:100%;margin:0 auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5);">
            <div class="card-header">
                &nbsp;
            </div>
            <div class="card-body">
                <div style="height:300px; overflow: auto;">
                    @foreach ($policyclients as $item )
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
        </div>
        @endif
    </div>
</div>
  <div class="card mb-4" id="cardInfoPersonal"style="display:none; width:100%;margin:0 auto;">
            <div class="card-header">
                <i class="fa-solid fa-id-card"></i>
                INFORMACION PERSONAL
            </div>
            <div class="card-body">
                <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                    Los campos marcados con * deben ser llenados obligatoriamente
                </div>
                <form autocomplete="off" action="{{url('/clients')}}{{$client!=null?'/'.$client->id:''}}" method="post" style="font-size: 14px"id="frmclient">
                    @csrf
                        <input type="hidden" name="id" value="{{$client?->id}}" id="id" >
                    @if($client!=null)
                        @method('PATCH')
                    @endif
                    @if(auth()->check())
                    <div class="row">
                        <div  class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for=""> REFERENCIA </label>
                                <input style="font-size: 12px" type="text" class="form-control"value="{{$client!=null?$client->reference: old('reference')}}"
                                    name="reference" id="reference">
                            </div>
                        </div>
                        <div  class="col-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for=""> CALIDAD DEL TITULAR </label>
                                <select style="font-size: 12px" class="form-select" name="quality_holder" id="quality_holder">
                                <option value="">Seleccione una opción </option>
                                    @foreach($QualityHolder as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->quality_holder_id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label"style="font-size:12px" for="">TITULO VALOR </label>
                                <input type="text" style="font-size: 12px" class="form-control" name ="value_Title" value="{{$client!=null?$client->value_Title:old('value_Title')}}" id="value_Title"/>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="" style="font-size:12px">NOMBRES Y APELLIDOS* </label>
                                <input type="text" style="font-size: 12px" class="form-control" name ="name_last_name" value="{{$client!=null?$client->name_last_name:old('name_last_name')}}" id="name_last_name"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="" style="font-size: 12px">#  DOCUMENTO*</label>
                                <input type="text" style="font-size: 12px" name="identification" id="identification" class="form-control" value="{{$client!=null?$client->identification:old('identification')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px" >FECHA DE NACIMIENTO*</label>
                                    <input type="date" style="font-size: 12px" name="birth_date" class="form-control" value="{{$client!=null?$client->date_birth:old('birth_date')}}"
                                            id="birth_date">
                            </div>
                            <div class="form-label"id="age" style="color:rgba(180, 158, 169, 1);font-size:10px">
                                EDAD:{{$client!=null? \Carbon\Carbon::parse($client->date_birth)->age:''}}
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px">FECHA DE EXPEDICION*</label>
                                <input type="date" style="font-size: 12px" name="expedition_date" class="form-control" value="{{$client!=null?
                                $client->expedition_date:old('expedition_date')}}"
                                id="expedition_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px">DIRECCION RESIDENCIA*</label>
                                <input type="text" style="font-size: 12px" class="form-control" value="{{$client!=null?$client->address:old('address')}}" name="address" id="address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for=""style="font-size: 12px">BARRIO* </label>
                                <input type="text" style="font-size: 12px" name="neighborhood" value="{{$client!=null?$client->neighborhood:old('neighborhood')}}" class="form-control" id="neighborhood">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                           <div class="col-sm-6">
                            <div class="mb-3" >
                            <label class="form-label" for=""style="font-size: 12px"> ESTADO CIVIL*</label>
                            <select name="marital_status" class="form-select" style="font-size: 12px" id="marital_status">
                            <option value="">Seleccione una opción </option>
                                    @foreach ($maritalstatus as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->marital_status_id?'selected':''}}{{$item->id==old('marital_status')?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for=""style="font-size: 12px"> EMAIL*</label>
                                <input type="email" value="{{$client!=null?$client->email:old('email')}}" style="font-size: 12px" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-6">
                            <div class="mb-3" >
                                <label class="form-label" for=""style="font-size: 12px"> NIVEL DE ESTUDIOS*</label>
                                <select name="study_level" class="form-select" style="font-size: 12px" id="study_level">
                                <option value="">Seleccione una opción </option>
                                    @foreach($studylevels as $item)
                                    <option value="{{$item->id}}"{{$item->id==$client?->level_study_id?'selected':''}}{{$item->id==old('study_level')?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="btnGuardar" class="btn btn-success">{{$client==null?'Guardar':'Actualizar'}}</button>
                </form>
            </div>
        </div>

<div class="card mb-4" id="cardPoltrataDatosPers"style="display:none;">
    <div class="card-header">
        <i class="fa-solid fa-database"></i>
        POLITICA DE TRATAMIENTO DE DATOS PERSONALES
    </div>
    <div class="card-body">
        <form action="{{url('/clients/UpdateDataProccess')}}/{{$client?->id}}"method="post" autocomplete="off">
            @method('patch')
            @csrf
            <iframe src="{{url('Politicas/Politicadedatos.pdf')}}" style="width:100%; height:500px;" frameborder="0"></iframe>
            <div style="padding: 5px; font-size:14px">
                <input type="checkbox" name="accept_data_treatment" id="accept_data_treatment"
                {{$client!=null&&$client->acept_data_processing_policies?'checked':''}}>
                <label for="accept_data_treatment">
                    Acepto la politica de tratamiento de datos personales
                </label>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
</div>
    <div class="card mb-4" id="cardDatosContacto" style="width:100%;margin:0 auto; display: none;">
        <div class="card-header">
            <i class="fa-solid fa-address-book"></i>
            INFORMACION DE CONTACTO
        </div>
        <div class="card-body">
            <a class="btn btn-primary"title="Crear datos de contacto" id="btnContact">
                <i class="fa-solid fa-square-phone-flip"></i>
            </a>
            <ul style="padding:0; margin-top:10px">
                @foreach($contactInfos as $item)
                <li style="list-style:none; padding-bottom:5px; display:flex; justify-content:space-between; align-items:center">
                    <strong>{{$item->phone_type->name}}: </strong>{{$item->phone_number}}
                    <form class="form form-inline" action="{{url('/contactinfo')}}/{{$item->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button title="Eliminar" class="btn btn-danger" type="button"
                            onclick="validar(this,'Desea eliminar este registro?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </li>
                @endforeach
            </ul>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Dato de contacto </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contactInfos as $item)
                            <tr>
                                <td>{{$item->phone_type->name.' '.$item->phone_number}}</td>
                                <td>
                                    <form  action="{{url('/contactinfo')}}/{{$item->id}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button title="Eliminar" class="btn btn-danger" type="button"
                                        onclick="validar(this,'Desea eliminar este registro?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

        </div>
    </div>
    <div class="card mb-4" id="cardInfoLaboral" style="display:none ; width:100%;margin:0 auto;">
        <div class="card-header">
            <i class="fa-solid fa-user-tie"></i>
            INFORMACION LABORAL
        </div>
        <div class="card-body">
             <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                Los campos marcados con * deben ser llenados obligatoriamente
            </div>
             <form autocomplete="off" action="{{url('/employmentInformations')}}{{$EmploymentInformation!=null?'/'.$EmploymentInformation->id:''}} "method="post" style="font-size: 14px">
                        @csrf
                        @if($EmploymentInformation!=null)
                            @method('PATCH')
                        @endif
                        <input type="hidden" name="client_id" value="{{$client!=null? $client->id:''}}" id="client_id" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA LABORA*
                                    </label>
                                    <input type="text"value="{{$EmploymentInformation!=null?$EmploymentInformation->company_works:old('company_works')}}" class="form-control" name="company_works" id="company_works" style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        NIT #*
                                    </label>
                                    <input type="text" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit_company_work:old('nit_company_works')}}" name="nit_company_works" id="nit_company_works"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DIRECCION OF. PPAL*
                                    </label>
                                    <input type="text" name="main_address" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->main_address:old('main_address')}}" id="main_address"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DEPARTAMENTO*
                                    </label>
                                    <select class="form-select" name="state" id="state"style="font-size: 12px">
                                        <option value="">Escoge un departamento </option>
                                        @foreach ($States as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->state_id?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CIUDAD*
                                    </label>
                                    <select class="form-select" name="city" id="city"style="font-size: 12px">
                                        <option value="">Escoge una ciudad  </option>
                                        @foreach ($cities as $item)
                                        <option value ="{{$item->id}}"{{$item->id==$EmploymentInformation?->city_id?'selected':''}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA EN MISION
                                    </label>
                                    <input type="text" name="company_on_mission" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->company_on_mission:old('company_on_mission')}}" id="company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        NIT EMPRESA MISION
                                    </label>
                                    <input class="form-control" type="text" name="nit_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit:old('nit_company_on_mission')}}" id="nit_company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        DIRECCION SEDE
                                    </label>
                                    <input class="form-control" type="text" name="address_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->branch_address:old('address_company_on_mission')}}" id="address_company_on_mission"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE INGRESO*
                                    </label>
                                    <input type="date" name="entry_date" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->entry_date:old('entry_date')}}" id="entry_date"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">SALARIO MENSUAL*</label>
                                    <input type="text" class="currency form-control" name="average_monthly_salary" value="${{$EmploymentInformation!=null?number_format($EmploymentInformation->average_monthly_salary):old('average_monthly_salary')}}" id="average_monthly_salary"style="font-size: 12px">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CARGO ACTUAL*
                                    </label>
                                    <input type="text" class="form-control" name="current_position" value="{{$EmploymentInformation!=null?$EmploymentInformation->current_position:old('current_position')}}" id="current_position"style="font-size: 12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">FRECUENCIA PAGOS*</label>
                                    <select class="form-select" name="payment_frequency" id="payment_frequency"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($PaymentFrecuencies as $item)
                                        <option value="{{$item->id}}"
                                            @if($item->id==$EmploymentInformation?->payment_frequency_id)
                                            selected
                                            @elseif(old('payment_frequency')!='')
                                            selected'
                                            @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE PAGO EMPRESA (FPE)*
                                    </label>
                                    <select class="form-select" name="company_payment_date" id="company_payment_date"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($CompanyPaymentDates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->company_payment_date_id?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        FECHA DE PAGO CLIENTE (FPC)*
                                    </label>
                                    <select class="form-select" name="custemer_payment_date" id="customer_payment_date"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($CustomerPaymentDates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->customer_payment_date_id?'selected':''}} >{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">TIPO DE CONTRATO*</label>
                                    <select class="form-select" name="contract_type" id="contract_type"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($ContractTypes as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->contract_type_id?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">EPS AFILIADA*</label>
                                    <select class="form-select" name="eps_affiliate" id="eps_affiliate"style="font-size: 12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($EpsAffiliates as $item)
                                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->eps_affiliate_id?'selected':''}} >{{$item->name}} </option>
                                        @endforeach
                                    </select>
                         <div style="font-size:12px">        <strong>Nota:</strong>   Si su  EPS no existe  en nuestra base de datos por favor creela  <a class="btnEps" href="#" id="btnEps"> aqui</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                 <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">ARL AFILIADA*</label>
                                    <select class="form-select" name="arl_affiliate" id="arl_affiliate"style="font-size: 12px">
                                        <option value="">Seleccione una opción </option>
                                        @foreach($ArlAffiliates as $item)
                                        <option value="{{$item->id}}" {{$item->id==$EmploymentInformation?->arl_affiliate_id?'selected':''}}>{{$item->name}} </option>
                                        @endforeach
                                    </select>
                                    <div style="font-size:12px">  <strong>Nota:</strong> Si su ARL no existe  en nuestra base de datos por favor creela <a class="btnArl" href="#" id="btnArl">aqui</a></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btnGuardar" class="btn btn-success">{{$EmploymentInformation==null?'Guardar':'Actualizar'}}</button>
            </form>

        </div>
    </div>
    <div class="card mb-4" id="cardInfoCrediticia" style="display:none; width:100%;margin:0 auto;">
        <div class="card-header">
            <i class="fa-solid fa-credit-card"></i>
            ACERCA EL CREDITO
        </div>
        <div class="card-body">
            <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                <h6>Los campos marcados con * deben ser llenados obligatoriamente </h6>
            </div>

                    <form autocomplete="off" action="{{url('/loans')}}{{$loan!=null?'/'.$loan->id:''}}"method="post" style="font-size:14px">
                        @if($loan!=null)
                            @method('PATCH')
                        @endif
                        @csrf
                        <input type="hidden" name="client_id"  value="{{$client!=null? $client->id:''}}" id="client_id" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        CREDITO SOLICITADO (COP)*
                                    </label>
                                    <input class="currency form-control" type="text" name="ammount" value="${{$loan!=null?number_format($loan->ammount):old('ammount')}}" id="ammount" style="font-size:12px">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        PLAZO SOLICITADO (Meses)*
                                    </label>
                                    <input class="form-control" type="number" name="term" value="{{$loan!=null?$loan->term:old('term')}}" id="term" style="font-size:12px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3" >
                                    <label class="form-label" for="">
                                        TIPO DE GARANTIA*
                                    </label>
                                    <select class="form-select" name="warranty" id="warranty" style="font-size:12px">
                                    <option value="">Seleccione una opción </option>
                                        @foreach($Warranties as $item)
                                        <option value="{{$item->id}}"{{$item->id==$loan?->warranty_id?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btnGuardar" class="btn btn-success">{{$loan==null?'Guardar':'Actualizar'}}</button>
                    </form>

        </div>
    </div>
    <div class="card mb-4" id="cardInfoPatrimonial" style="width:60%;margin:0 auto;display: none;">
        <div class="card-header">
            <i class="fa-solid fa-building-user"></i>
            INFORMACION PATRIMONIAL
        </div>
        <div class="card-body">

                    <form autocomplete="off" action="{{url('/clients/UpdatePatrimonialInformation')}}/{{$client!=null?$client->id:0}}"method="post" style="font-size:14px">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-sm-6 ">
                            <label class="form-check-label">
                                <input type="checkbox" {{$client?->vehicle==1?'checked':'' }} name="vehicle" id="vehicle">
                                POSEE VEHICULO
                            </label>
                        </div>
                        <div class="col-sm-6 " >
                            <label class="form-check-label" for="">
                                <input type="checkbox" name="estate" {{$client?->estate==1?'checked':'' }} id="estate">
                                POSEE PROPIEDADES
                            </label>
                        </div>
                        </div>
                        <div>
                            <button type="submit" id="btnGuardar" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>

        </div>
    </div>
    <div class="card mb-4" id="cardInfoLegal" style="width:100%;margin:0 auto;display: none;">
        <div class="card-header">
            <i class="fa-solid fa-scale-balanced"></i>
            INFORMACION LEGAL
        </div>
        <div class="card-body">

                    <form autocomplete="off" action="{{url('/clients/UpdateLawInformation')}}/{{$client!=null?$client->id:0}}"method="post"style="font-size:14px">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-check form-check-inline" >
                                    <label class="form-check-label" for="">
                                        <input type="checkbox"  name="seizure" {{$client?->seizure==1?'checked':'' }} id="seizure">
                                        TIENE EMBARGOS
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-7" id="divCompanySeizure" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label" for="">
                                        EMPRESA QUE LO EMBARGA
                                    </label>
                                    <input type="text" class="form-control" value="{{$client?->company_seizure}}" name="company_seizure"  id="company_seizure">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" id="btnGuardar" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>

        </div>
    </div>-->
    <script type="text/javascript">
        var acc = document.getElementsByClassName("acordion");
        for(var i=0; i < acc.length; i++)
        {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("activo");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block")
                {
                    panel.style.display = "none";
                }
                else
                {
                    panel.style.display = "block";
                }
            });
        }
    </script>
@endsection

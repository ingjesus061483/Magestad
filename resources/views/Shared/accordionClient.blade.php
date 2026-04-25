<div id="accordion">
    <h3>
        <i class="fa-solid fa-id-card"></i>
        INFORMACION PERSONAL
    </h3>
    <div>
        <div style="padding: 5px;color:rgba(180, 158, 169, 1);
        font-size:12px">
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
                <div  class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label"style="font-size:12px" for="">
                             REFERENCIA
                        </label>
                        <input style="font-size: 12px" type="text" class="form-control"value="{{$client!=null?$client->reference: old('reference')}}"
                            name="reference" id="reference">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label"style="font-size:12px" for="">
                            TITULO VALOR
                        </label>
                        <div class="row">
                            <div class="col-3" >
                                <input type="text" style="font-size: 12px" class="form-control" name ="letter" readonly value="L" id="letter"/>
                            </div>
                            <div class="col-9">
                                <input type="text" style="font-size: 12px" class="form-control" name="consecutive" value="{{$client!=null?($client->value_Title!=''? explode('-',$client->value_Title)[1]:''):(old('consecutive')!=''? old('consecutive'):'')}}" id="consecutive"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div  class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label"style="font-size:12px" for="">
                             CALIDAD DEL TITULAR*
                        </label>
                        <select style="font-size: 12px" class="form-select" name="quality_holder" id="quality_holder">
                            <option value="">Seleccione una opción </option>
                            @foreach($QualityHolder as $item)
                            <option value="{{$item->id}}"{{$item->id==$client?->quality_holder_id?'selected':(old('quality_holder')==$item->id?'selected':'')}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="" style="font-size:12px">
                            NOMBRES Y APELLIDOS*
                        </label>
                        <input type="text" style="font-size: 12px" class="form-control" name ="name_last_name" value="{{$client!=null?$client->name_last_name:old('name_last_name')}}" id="name_last_name"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="" style="font-size: 12px">
                            #  DOCUMENTO*
                        </label>
                        <input type="text" style="font-size: 12px" name="identification" id="identification" class="form-control" value="{{$client!=null?$client->identification:old('identification')}}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3" >
                        <label class="form-label" for=""style="font-size: 12px">
                            FECHA DE NACIMIENTO*
                        </label>
                        <input type="date" style="font-size: 12px" name="birth_date" class="form-control"
                        value="{{$client!=null?$client->date_birth:old('birth_date')}}" id="birth_date">
                    </div>
                    <div class="form-label"id="age" style="color:rgba(180, 158, 169, 1);font-size:10px">
                        EDAD:{{$client!=null? \Carbon\Carbon::parse($client->date_birth)->age:''}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for=""style="font-size: 12px">
                            FECHA DE EXPEDICION*
                        </label>
                        <input type="date" style="font-size: 12px" name="expedition_date" class="form-control" value="{{$client!=null?
                                $client->expedition_date:old('expedition_date')}}"
                                id="expedition_date">
                    </div>
                </div>
                    <div class="col-sm-6">
                    <div class="mb-3" >
                        <label class="form-label" for=""style="font-size: 12px">
                            DIRECCION RESIDENCIA*
                        </label>
                        <input type="text" style="font-size: 12px" class="form-control" value="{{$client!=null?$client->address:old('address')}}" name="address" id="address">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for=""style="font-size: 12px">
                            BARRIO*
                        </label>
                        <input type="text" style="font-size: 12px" name="neighborhood" value="{{$client!=null?$client->neighborhood:old('neighborhood')}}" class="form-control" id="neighborhood">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for=""style="font-size: 12px">
                            CIUDAD DE RESIDENCIA*
                        </label>
                        <input type="text" style="font-size: 12px" value="{{$client!=null?$client->city?->name.' | '.$client->city?->state->name :old('city')}}" class="form-control" id="city_name">
                        <input type="hidden" name="city_id" value="{{$client!=null?$client->city_id:old('city_id')}}" id="city_id">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3" >
                        <label class="form-label" for=""style="font-size: 12px">
                            ESTADO CIVIL*
                        </label>
                        <select name="marital_status" class="form-select" style="font-size: 12px" id="marital_status">
                            <option value="">Seleccione una opción </option>
                            @foreach ($maritalstatus as $item)
                            <option value="{{$item->id}}"{{$item->id==$client?->marital_status_id?'selected':''}}
                                {{$item->id==old('marital_status')?'selected':''}}>{{$item->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for=""style="font-size: 12px">
                            EMAIL*
                        </label>
                        <input type="email" value="{{$client!=null?$client->email:old('email')}}" style="font-size: 12px" class="form-control" name="email" id="email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3" >
                        <label class="form-label" for=""style="font-size: 12px">
                            NIVEL DE ESTUDIOS*
                        </label>
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
        <div class="row">
            <div class="col-sm-6">
                <div style="padding: 5px;color:rgba(180, 158, 169, 1);font-size:12px">
                    Los campos marcados con * deben ser llenados obligatoriamente
                </div>
                <form action="{{url('/contactinfo')}}" autocomplete="off" method="POST" id="frmContact">
                    @csrf
                    <input type="hidden"  value="{{isset($client)? $client->id:''}}" name="client_id" id="client_id" >
                    <div class="mb-3">
                        <label class="form-label" for="" style="font-size: 14px;">
                            Tipo de contacto*
                        </label>
                        <select class="form-select" name="phone_type" style="width:80;font-size:12px " id="phone_type">
                            <option value="">Seleccione una opcion</option>
                            @if(isset($phonetypes))
                            @foreach($phonetypes as $item)
                            <option value="{{$item->id}}">{{ $item->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="" style="font-size:14px" >
                            Numero de telefono*
                        </label>
                        <input type="tel" name="phone" class="form-control"style="font-size:12px;" id="phone">
                    </div>
                    <button type="submit" title="Guardar" id="btnGuardar" class="btn btn-success" style="margin-top:10px">
                        Guardar
                    </button>

                </form>
            </div>
            <div class="col-sm-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($contactInfos as $item)
                        <tr>
                            <td>{{$item->phone_type->name}}</td>
                            <td>{{$item->phone_number}}</td>
                            <td>
                                <form class="form form-inline" action="{{url('/contactinfo')}}/{{$item->id}}" method="POST">
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
                    <label for="">Posicion ocupacional* </label>
                    <select class="form-select" name="occupational_position" id="occupational_position" style="font-size: 12px">
                        <option value="">Selecione una opcion</option>
                        @foreach ($occupationalposition as $item)
                        <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->occupational_position_id?'selected':''}}{{old('occupational_position')!=''?'selected':''}} >{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            EMPRESA LABORA
                        </label>
                        <input type="text"value="{{$EmploymentInformation!=null?$EmploymentInformation->company_works:old('company_works')}}" class="form-control" name="company_works" id="company_works" style="font-size: 12px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            NIT #
                        </label>
                        <input type="text" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit_company_work:old('nit_company_works')}}" name="nit_company_works" id="nit_company_works"style="font-size: 12px">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            DIRECCION OF. PPAL*
                        </label>
                        <input type="text" name="main_address" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->main_address:old('main_address')}}" id="main_address"style="font-size: 12px">
                    </div>
                </div>
            </div>
            <div class="row">
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
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            EMPRESA EN MISION
                        </label>
                        <input type="text" name="company_on_mission" class="form-control"
                        value="{{$EmploymentInformation!=null?$EmploymentInformation->company_on_mission:old('company_on_mission')}}"
                        id="company_on_mission"style="font-size: 12px">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            NIT EMPRESA MISION
                        </label>
                        <input class="form-control" type="text" name="nit_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->nit:old('nit_company_on_mission')}}" id="nit_company_on_mission"style="font-size: 12px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            DIRECCION SEDE
                        </label>
                        <input class="form-control" type="text" name="address_company_on_mission" value="{{$EmploymentInformation!=null?$EmploymentInformation->branch_address:old('address_company_on_mission')}}" id="address_company_on_mission"style="font-size: 12px">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            FECHA DE INGRESO*
                        </label>
                        <input type="date" name="entry_date" class="form-control" value="{{$EmploymentInformation!=null?$EmploymentInformation->entry_date:old('entry_date')}}" id="entry_date"style="font-size: 12px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">SALARIO MENSUAL*</label>
                        <input type="text" class="currency form-control" name="average_monthly_salary" value="{{$EmploymentInformation!=null?'$'.number_format($EmploymentInformation->average_monthly_salary):old('average_monthly_salary')}}" id="average_monthly_salary"style="font-size: 12px">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            CARGO ACTUAL*
                        </label>
                        <input type="text" class="form-control" name="current_position" value="{{$EmploymentInformation!=null?$EmploymentInformation->current_position:old('current_position')}}" id="current_position"style="font-size: 12px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">
                            FRECUENCIA PAGOS*
                        </label>
                        <select class="form-select" name="payment_frequency" id="payment_frequency"style="font-size: 12px">
                            <option value="">Seleccione una opción </option>
                            @foreach($PaymentFrecuencies as $item)
                            <option value="{{$item->id}}" {{$item->id==$EmploymentInformation?->payment_frequency_id?'selected':''}}{{old('payment_frequency')!=''?'selected':''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
            </div>
            <div class="row">
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
                <div class="col-sm-6">
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
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">EPS AFILIADA*</label>
                        <select class="form-select" name="eps_affiliate" id="eps_affiliate"style="font-size: 12px">
                            <option value="">Seleccione una opción </option>
                            @foreach($EpsAffiliates as $item)
                            <option value="{{$item->id}}"{{$item->id==$EmploymentInformation?->eps_affiliate_id?'selected':''}}{{old('eps_affiliate')!=''?'selected':''}} >{{$item->name}} </option>
                            @endforeach
                            <option value="-1">OTROS </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="">ARL AFILIADA*</label>
                        <select class="form-select" name="arl_affiliate" id="arl_affiliate"style="font-size: 12px">
                            <option value="">Seleccione una opción </option>
                            @foreach($ArlAffiliates as $item)
                            <option value="{{$item->id}}" {{$item->id==$EmploymentInformation?->arl_affiliate_id?'selected':''}}{{old('arl_affiliate')!=''?'selected':''}}>{{$item->name}} </option>
                            @endforeach
                             <option value="-1">OTROS </option>
                        </select>
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
                <button type="submit" id="btnGuardar" class="btn btn-success">
                    Actualizar
                </button>
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
            <div style="padding-top: 5px" >
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
                            <option value="{{$item->id}}"{{$item->id==$loan?->warranty_id?'selected':''}}{{old('warranty')!=''?'selected':''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3" >
                        <label class="form-label" for="">
                            TIPO DE CREDITO
                        </label>
                        <select class="form-select" name="loan_type" id="loan_type" style="font-size:12px">
                            <option value="">Seleccione una opción </option>
                            @foreach($loantypes as $item)
                            <option value="{{$item->id}}"
                                {{$item->id==$loan?->loan_type_id?'selected':''}}{{old('loan_type')!=''?'selected':''}}>{{$item->name}}</option>

                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <button {{auth()->check()?'':( $client?->quality_holder_id==2||$client?->quality_holder_id==3?'disabled':'')}}   type="submit" id="btnGuardar" class="btn btn-success">{{$loan==null?'Guardar':'Actualizar'}}</button>
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
          <!--  <iframe src="{{url('Politicas/Politicadedatos.pdf')}}" style="width:100%; height:500px;" frameborder="0"></iframe>-->
            <div style="padding: 5px; font-size:14px">
                <input type="checkbox" name="accept_data_treatment" id="accept_data_treatment"
                {{$client!=null&&$client->acept_data_processing_policies?'checked':''}}>
                <label for="accept_data_treatment">
                    Acepto los <a href="#"> terminos y condiciones</a>, he leido y comprendido la <a href="#"> politica de privacidad </a> y autorizo el tratamiento de mis datos personales para los fines relacionados con la gestion del credito solicitado, asi como para el envio de comunicaciones comerciales relacionadas con los productos y servicios ofrecidos por la entidad.
                </label>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
      <h3>
          <i class="fa-solid fa-building-shield"></i>
          POLITICAS {{count($policyclients).' | '.$policiesCount}}
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
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($policies as $item)
                    <div id="{{$item->title}}" style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
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
                                    <button type="button"  title="Si Acepto" data-state="1" data-panel="{{$item->title}}" onclick="submitPolicy(this)" style="width:100%; " class="btn btn-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;"data-state="2" data-panel="{{$item->title}}" onclick="submitPolicy(this)">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button"title ="No entiendo"data-state="3" data-panel="{{$item->title}}" class="btn btn-warning"style="width:100%; " onclick="submitPolicy(this)">
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
        @if(count($policyclients)>0 && count($policies)==0 )
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
    <h3>
          <i class="fa-solid fa-file-pen"></i>
          AUTORIZACIONES {{count($autorizationsclients).' | '.$autorizationsCount}}
      </h3>
    <div>
        <div>
            <ul style="font-size:10px">
                <li style="list-style:none;font-weight:bold; color: green"><i class="fa-solid fa-circle-check"></i> Si acepto </li>
                <li style="list-style:none;font-weight:bold; color: red"><i class="fa-solid fa-circle-xmark"></i>  No acepto</li>
                <li style="list-style:none;font-weight:bold; color:orange"><i class="fa-solid fa-circle-question"></i> No entiendo</li>
            </ul>
        </div>
        @if(count($autorizations)>0)
        <div  class="card mb-4" style="width:100%;margin:10px auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5); ">
            <div class="card-body">
                <div style="height:300px;overflow: auto;">
                @foreach($autorizations as $item)
                <div id="{{$item->title}}" style="width:100%; margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
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
                                <button type="button" title="Si Acepto" data-state="1" data-panel="{{$item->title}}" onclick="submitPolicy(this)" style="width:100%; " class="btn btn-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" title="No acepto" class="btn btn-danger"style="width:100%;" data-state="2" data-panel="{{$item->title}}" onclick="submitPolicy(this)">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button"title ="No entiendo" class="btn btn-warning"style="width:100%; "data-state="3" data-panel="{{$item->title}}" onclick="submitPolicy(this)">
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
        @if(count($autorizationsclients)>0 && count($autorizations)==0 )
         <div style="width:100%;margin:0 auto;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.5);">
            <div class="card-header">
                &nbsp;
            </div>
            <div class="card-body">
                <div style="height:300px; overflow: auto;">
                    @foreach ($autorizationsclients as $item )
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

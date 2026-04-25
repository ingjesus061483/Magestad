  <div id="dialogHomework" title="Tareas" >
            <form id="frmHomework" action="{{url('homework')}}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="user_id" value="{{auth()->check()?auth()->user()->id:''}}">
                <div class="mb-3">
                    <label for=""style="font-size:14px" >Fecha*</label>
                    <input type="date" class="form-control" name="date" style="width:80%;font-size:12px; " value="{{date('Y-m-d')}}" id="dete">
                </div>
                <div class="mb-3">
                    <label for=""style="font-size:14px" >Cliente*</label>
                    <input type="text"  class="client form-control" name="client_id" style="width:80%;font-size:12px; " />
                   <!-- <datalist id="clients" style="width:80%;font-size:12px; ">
                        @if (isset($clients))
                            @foreach($clients as $item)
                            <option value="{{$item->id}}">{{$item->identification.'-'.$item->name_last_name}}</option>
                            @endforeach
                        @endif
                    </datalist>-->
                </div>
                <div class="mb-3">
                    <label for="" style="font-size:14px" style="width:80%;font-size:12px; ">Novedad*</label>
                    <textarea name="remark" id="remark" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </form>
        </div>
        <div title="Usuarios" id="dialogUser" style="padding-top:10px">
            <form action="{{url('/users')}}" method="POST"autocommplete="off" id="frmUser">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Nombre*</label>
                    <input type="text" name="name" class="form-control" style="width:80%;font-size:12px" id="name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Contraseña*</label>
                    <input type="password" name="password" class="form-control" style="width:80%;font-size:12px" id="password">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password-confirmation">
                        Confirmar Contraseña
                    </label>
                    <input type="password" name="password_confirmation" style="width:80%;font-size:12px" id="password_confirmation" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Telefono*</label>
                    <input type="text" name="phone" class="form-control" style="width:80%;font-size:12px" id="phone">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Email*</label>
                    <input type="email" name="email" class="form-control" style="width:80%;font-size:12px" id="email">
                </div>
            </form>
        </div>
        <div title="Tipos de documentos" id="dialogDocumentType">
            <form id ="frmDocumentType" action="{{url('/DocumentType')}}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Nombre*</label>
                    <input type="text" name="name" class="form-control" style="width:80%;font-size:12px" id="name">
                </div>
                @if (auth()->check())
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size: 14px"> Descripcion</label>
                    <textarea name="description" id="description" style="font-size: 12px" class="form-control" cols="30" rows="10"></textarea>
                </div>
                @endif
            </form>
        </div>
        <div title="Ver documentos" id="dialogViewDocuments">
            <div style="width:60%; margin:0 auto">
                <table class="table table-hover table-bordered" id="tblDocuments" style="width:100%">
                    <thead style ="font-size: 14px">
                        <tr>
                            <th>#</th>
                            <th>DOCUMENTO</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody style ="font-size: 12px">
                    </tbody>
                </table>
            </div>
        </div>
        <div title="Adjuntar documentos" id ="dialogAttach">
            <form id="frmAttach" autocomplete="off" enctype="multipart/form-data" method="POST" action=" {{url('/documents')}}">
                @csrf
                <input type="hidden"  value="{{isset($client)? $client->id:''}}" name="client" id="client" >
                <input type="hidden" name="document_type" id="document_type">

                <div class="custom-file mb-3">
                    <input type="file"accept="image/*"  name="file"  class="custom-file-input"  id="customfile">
                    <label class="custom-file-label" for="customFile">Escoge un archivo </label>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size:14px" >Descripcion</label>
                    <textarea class="form-control" name="description" ></textarea>
                </div>
            </form>
        </div>
        <div title="Autorizaciones y politicas" id="dialogPolicy">
            <form id ="frmPolicy" action="{{url('/authorizationPolicies')}}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Titulo*</label>
                    <input type="text" name="title" class="form-control" style="width:80%:font-size:12px" id="title">
                </div>
                <div class="mb-3">
                    <label class="form-label" for=""> Contenido*</label>
                    <textarea name="description" id="description" class="form-control" style="font-size: 12px" cols="30" rows="10"></textarea>
                </div>

            </form>
        </div>
        <div title="EPS" id="dialogEps">
            <form id ="frmEps" action="{{url('/eps')}}" method="POST" autocomplete="off">
                @csrf
                <p style="color:gray;font-style: italic; font-size:14px">Registre aqui su EPS</p>
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Nombre*</label>
                    <input type="text" name="name" class="form-control" style="width:80%;font-size12px " id="name">
                </div>
                @if (auth()->check())
                <div class="mb-3">
                    <label class="form-label" for=""> Descripcion</label>
                    <textarea name="description" id="description" class="form-control" style="font-size:12px;" cols="30" rows="10"></textarea>
                </div>
                @endif
            </form>
        </div>
        <div title="ARL" id="dialogArl">
            <form id ="frmArl" action="{{url('/arls')}}" method="POST" autocomplete="off">
                @csrf
                <p style="color:gray;font-style: italic; font-size:14px">Registre aqui su ARL</p>
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Nombre*</label>
                    <input type="text" name="name" class="form-control" style="width:80%;font-size:12px; " id="name">
                </div>
                @if (auth()->check())
                <div class="mb-3">
                    <label class="form-label" for=""> Descripcion</label>
                    <textarea name="description" id="description" style="font-sive:12px" class="form-control" cols="30" rows="10"></textarea>
                </div>
                @endif
            </form>
        </div>
        <div id="dialogfilter">
            <form  method="get" autocomplete="off" id="frmfilter">
                @csrf

                <div class="mb-3">
                    <label for=""style="font-size:14px" >Fecha inicio</label>
                    <input type="date" class="form-control" name="dateStart" style="font-size:12px; " value="{{date('Y-m-d')}}" id="deteStart">
                </div>
                         <div class="mb-3">
                    <label for=""style="font-size:14px" >Fecha final</label>
                    <input type="date" class="form-control" name="dateEnd" style="font-size:12px; " value="{{date('Y-m-d')}}" id="dateEnd">
                </div>
                <div class="mb-3">
                    <label for=""style="font-size:14px" >Cliente*</label>
                    <input type="text" class="client form-control" name="client_id" style="font-size:12px;" />
                </div>
                @if(isset($newnesstypes))
                <div class="mb-3">
                    <label for=""style="font-size:14px" >Tipo de novedad</label>
                    <select name="newnesstype_id" class="form-select" style="font-size:12px; ">
                        <option value="">Seleccione una opcion</option>
                        @foreach($newnesstypes as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif


            </form>
        </div>
        <div title="Tipos de novedades" id="dialogNewnessType">
            <form id ="frmNewnessType" action="{{url('/NewnessType')}}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="" style="font-size:14px"> Nombre*</label>
                    <input type="text" name="name" class="form-control" style="width:80%;font-size:12px; " id="name">
                </div>
                @if (auth()->check())
                <div class="mb-3">
                    <label class="form-label" for=""tyle="font-size:14px" > Descripcion</label>
                    <textarea name="description" id="description" style="font-sive:12px" class="form-control" cols="30" rows="10"></textarea>
                </div>
                @endif
            </form>
        </div>
        <div title="Información de contacto" id="dialogContact">

                    <form action="{{url('/contactinfo')}}" autocomplete="off" method="POST" id="frmContact">
                            @csrf
                            <input type="hidden"  value="{{isset($client)? $client->id:''}}" name="client_id" id="client_id" >
                            <div class="mb-3">
                                <label class="form-label" for="" style="font-size: 14px;"> Tipo de contacto</label>
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
                                    Numero de telefono
                                </label>
                                <input type="tel" name="phone" class="form-control"style="width:80%; font-size:12px;" id="phone">
                            </div>
                        </form>

        </div>

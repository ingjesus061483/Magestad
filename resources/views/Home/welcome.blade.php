@extends('Shared.menubutton')
@section('title','Inicio')
@section('content')

        <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                 <div class="d-flex justify-content-center align-items-center mb-3">
                    <img class="sidebar-card-illustration mb-2" src="{{url('ImagenSistema/cs.png')}}" alt="...">
                 </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6">
                        @if(auth()->check())
                        <div class="d-flex justify-content-start gap-2">
                            <div id="fastSearch" onmouseover="ShowSubconfig('subFastsearch')" onmouseout="HideSubconfig('subFastsearch')" style="position: relative; display: inline-block;">
                                <button title="" class="btn boton" style="text-align:center; color:gray;" >
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <div id="subFastsearch" style="display: none; position: absolute; top: 100%;  left:  0%; padding: 5px; color:black;  white-space: nowrap; background: white; border: 1px solid #ddd; box-shadow: 0 0 8px rgba(0,0,0,.1);">
                                    <ul style="list-style-type: none; margin: 0; padding: 0;">
                                        <li><a  href="{{url('clients')}}" style="color: black;">BD | Cliente</a></li>
                                         <li><a href="{{url('Newness')}} " style="color: black;">Novedades</a></li>
                                        <li><a  href="{{url('homework')}}" style="color: black;">Tareas</a></li>
                                        <li ><a href="{{url('requestLoan')}}" style="color: black;">Solicitud de préstamo</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end gap-2">
                            @if(!auth()->check())
                            <div id="CreateClient" onmouseover="ShowSubconfig('subCreateClient')" onmouseout="HideSubconfig('subCreateClient')" style="position: relative; display: inline-block;">
                                <a class="btn boton"  style="text-align:center; color:gray; " >
                                    <i class="fa-solid fa-sack-dollar"></i>
                                   <!-- <i class="fa-solid fa-credit-card"></i>-->
                                </a>
                                <div id="subCreateClient" style="display: none; position: absolute; top: 100%; right:  0%; padding: 5px; color:black; white-space: nowrap; background: white; border: 1px solid #ddd; box-shadow: 0 0 8px rgba(0,0,0,.1);">
                                     <ul style="list-style-type: none; margin: 0; padding: 0;">
                                        <li><a style="text-decoration: none; color: black;" href="{{url('/clients/create')}}">Formato de solicitud de credito</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="loginUser" onmouseover="ShowSubconfig('subLogin')" onmouseout="HideSubconfig('subLogin')" style="position: relative; display: inline-block;">
                                <button class="btn boton" style="text-align:center; color:gray;">
                                    <i class="fa-solid fa-user-lock"></i>
                                </button>
                                <div id="subLogin" style="display: none; position: absolute; top: 100%; width:200px; right:  0%; padding: 5px; color:black;  white-space: nowrap; background: white; border: 1px solid #ddd; box-shadow: 0 0 8px rgba(0,0,0,.1);">
                                    <form action="{{url('users/sigin')}}" autocomplete="off" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="inputEmail" type="email" placeholder="Email" />
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn " type="submit">
                                                <img class="rounded-circle" height="20px" width="20px" src="{{asset('resources/img/login.png')}}"
                                                alt="...">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                            <div id="config" onmouseover="ShowSubconfig('subConfig')" onmouseout="HideSubconfig('subConfig') "style="position: relative; display: inline-block;">
                                <button class="btn boton " href="" style="text-align:center; color:gray;" >
                                    <i class="fas fa-fw fa-cog"></i><br>
                                </button>
                                <div id="subConfig" style="display: none; position: absolute; top: 100%; right:  0%; padding: 5px; color:black;  white-space: nowrap; background: white; border: 1px solid #ddd; box-shadow: 0 0 8px rgba(0,0,0,.1);">
                                    <ul style="list-style-type: none;  margin: 0; padding: 0;">
                                        <li><a style="text-decoration: none; color: black;"  href="{{url('/NewnessType')}}">Tipos de novedades</a></li>
                                        <li> <a style="text-decoration: none; color: black;"  href="{{url('/DocumentType')}}">Tipos de documentos</a></li>
                                        <li> <a style="text-decoration: none; color: black;"  href="{{url('/arls')}}">ARL</a></li>
                                        <li> <a style="text-decoration: none; color: black;"  href="{{url('/eps')}}">EPS</a></li>
                                        <li> <a style="text-decoration: none; color: black;"  href="{{url('/authorizationPolicies')}}"> Politicas y autorizaciones</a></li>
                                        <li> <a style="text-decoration: none; color: black;"  href="{{url('/users')}}">Usuarios</a></li>
                                    </ul>
                                </div>
                            </div>
                            <a class="nav-link dropdown-toggle"  id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{auth()->user()->name}}
                                </span>
                               <i class="fa-solid fa-user"></i>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>

                            </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <img src="{{url('/ImagenSistema/Magestad_azul.png')}}" class="img-fluid mx-auto d-block" style="width:100px; height:100px;" alt="">
                </div>
                <div class="p-3">
                    <div class="text-center">
                        <h1 id="welcome-title" class="h4 text-gray-900 mb-4" style="font-style: italic">Bienvenidos a Magestad</h1>
                    </div>
                    @if(auth()->check())
                    <div class="module row" style="justify-content: center;align-items: center;">
                        <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                            <button class="btn boton" onclick="showSubmodule('subClient')"  style="text-align:center; color:gray; " >
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size:30px" ></i><br>
                                <span style=" color: black;"> BASE DE DATOS</span>
                            </button>
                        </div>
                        <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                            <button class="btn boton" onclick="showSubmodule('subControl')"  style="text-align:center; color:gray; " >
                                <i class="fa-solid fa-traffic-light" style="font-size: 30px"></i><br>
                                <span style="color: black;"> CONTROL</span>
                            </button>
                        </div>
                    </div>
                    <div class="module row" style=" justify-content: center;align-items: center;">
                        <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                            <button class="btn boton" onclick="showSubmodule('subDay')"  style="text-align:center; color:gray;" >
                                <i class="fa-solid fa-book-open" style="font-size: 30px"></i><br>
                                <span style="color: black; " > DIARIO</span>
                            </button>

                        </div>
                        <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                            <button class="btn boton"  style="text-align:center; color:gray;" >
                                <i class="fa-solid fa-chart-line"style="font-size: 30px"></i><br>
                                <span style="color: black; " > INDICADORES</span>
                            </button>
                        </div>
                    </div>
                    <div class="module row" style=" justify-content: center;align-items: center;">
                    <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                        <button class="btn boton"  style="text-align:center; color:gray;">
                            <i class="fa-solid fa-calendar-days"style="font-size: 30px"></i><br>
                            <span style="color: black; " > AGENDA</span>
                        </button>
                    </div>
                    <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                        <button class="btn boton"  style="text-align:center; color:gray;" >
                            <i class="fa-regular fa-newspaper" style="font-size: 30px"></i><br>
                            <span style="color: black; " > REPORTES</span>
                        </button>
                    </div>
                    </div>
                    <div class="module row" style=" justify-content: center;align-items: center;">
                        <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                            <button class="btn boton" style="text-align:center; color:gray;">
                                <i class="fa-solid fa-bell" style="font-size: 30px"></i><br>
                                 <span style="color: black; " >ALERTAS</span>
                               <!-- <span class="badge badge-danger badge-counter">3+</span>-->
                            </button>
                        </div>
                        <div class="col-6" style="display:grid; justify-content: center;align-items: center;">
                            <button class="btn boton" style="text-align:center; color:gray;">
                                <img src="{{url('ImagenSistema/actividad.png')}}" alt="Actividad" style="width: 30px; height: 30px;"><br>
                                 <span style="color: black; " >ACTIVIDAD</span>

                               <!-- <span class="badge badge-danger badge-counter">3+</span>-->
                            </button>
                        </div>
                    </div>

                    <div id="subClient" style="display: none;" class="mt-4 subModule">
                        <h1 class="h4 text-center text-gray-900" ><i class="fa-solid fa-cloud-arrow-up" style="font-size:30px" ></i> BASE DE DATOS</h1>
                        <ul style="list-style-type: none; margin: 0; padding-bottom: 20px;">
                            <li><a style="text-decoration: none;color: black" href="{{url('clients')}}" ><i class="fa-solid fa-user-tie"></i> BD | Cliente</a></li>
                                   <!-- <li><a style="text-decoration: none;" href="">Proveedores</a></li>-->
                        </ul>
                    </div>
                    <div id="subControl" style="display: none; padding: 5px;" class="mt-4 subModule">
                        <h1 class="h4 text-center text-gray-900 mb-4" >
                           <i class="fa-solid fa-traffic-light" style="font-size: 30px"></i> CONTROL</h1>

                    </div>
                    <div id="subDay" style="display: none;padding: 5px " class="mt-4 subModule   ">

                        <h1 class="h4 text-center text-gray-900" ><i class="fa-solid fa-calendar-days" style="font-size: 30px"></i> DIARIO</h1>
                        <ul style="list-style-type: none; margin: 0; padding-bottom: 20px;">
                            <li><a style="text-decoration: none; color: black;" href="{{url('Newness')}} "><i class="fa-solid fa-pencil"></i> Novedades</a></li>
                            <li><a style="text-decoration: none; color: black;" href="{{url('homework')}}"><i class="fa-solid fa-tasks"></i> Tareas</a></li>
                            <li ><a style="text-decoration: none; color: black;" href="{{url('requestLoan')}}"><i class="fa-solid fa-hand-holding-usd"></i> Solicitud de préstamo</a></li>
                        </ul>
                    </div>
                    <div id="subIndicators" style="display: none; padding: 5px;" class="mt-4 subModule">
                        <h1 class="h4 text-center text-gray-900 mb-4" ><i class="fa-solid fa-chart-line"style="font-size: 30px"></i> INDICADORES</h1>
                    </div>
                     <div id="subAgenda" style="display: none; padding: 5px;" class="mt-4 subModule">
                        <h1 class="h4 text-center text-gray-900 mb-4" ><i class="fa-solid fa-calendar-days"style="font-size: 30px"></i> AGENDA</h1>
                    </div>
                     <div id="subReports" style="display: none; padding: 5px;" class="mt-4 subModule  ">
                        <h1 class="h4 text-center text-gray-900 mb-4" ><i class="fa-regular fa-newspaper" style="font-size: 30px"></i> REPORTES</h1>
                    </div>
                    <div id="return"  style="justify-content:end;justify-content:end;align-content:end; display: none;">
                        <button class=" btn-sm btn-secondary boton" onclick="returnMenu()"   >
                            <i class="fa-solid fa-arrow-left" ></i>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

@endsection

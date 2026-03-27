<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link href="{{url('/css/styles.css')}}" rel="stylesheet" />
        <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.3.4/datatables.min.css" rel="stylesheet" integrity="sha384-R5Azes02wvL9ervyq6xo5WLyg1ufX0qwun0F/0qos0E0wNjnnRTADTQpjpnNLakj" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="{{url('/img/magestad.ico')}}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css">
        <link href="{{url('/jquery-ui-1.12.1.custom/jquery-ui.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <input type="hidden" id="base_url" value="{{url('/')}}/">
        <input type="hidden" id="info" value="{{isset($info)?$info:''}}">
        <input type="hidden" id="client" value="{{isset($client)?$client->id:''}}">
        <input type="hidden" id="user" value="{{auth()->check()? auth()->user()->id :''}}">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{url('/')}}">Magestad</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
        <!--    @if(!isset($client))
            <form action="{{url('/clients/0')}}" method="GET" autocapitalize="off" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input name="identification" class="form-control" type="text" placeholder="Digite su CC" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit "><i class="fas fa-search"></i></button>
                </div>
            </form>
            @else
            <a href="{{url('/clients')}}/{{$client->id}}" class="btn btn-primary ms-auto me-0 me-md-3 my-2 my-md-0">
                <i class="fa-solid fa-user-tie"></i>&nbsp;{{$client->name_last_name}}</a>
            @endif-->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                @if (auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form  action="{{url('users/logout')}}"
                             method="post">
                            @csrf
                            <button title="Cerrar sesion" type="button" onclick="validar(this,'Desea cerrar la sesion?')" class="btn">
                              Cerrar sesion  <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user-check"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{url('users/login/0')}}">Login</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            @include('Shared.menu')
                        </div>
                    </div>
                    @if(auth()->check())
                    <div class="sb-sidenav-footer">
                        <div class="small">
                            Logged in as:&nbsp;{{auth()->user()->name}}
                        </div>
                    </div>
                    @endif
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @if(session('message'))
                            <div  id="message" style="display: none" class="alert alert-success">
                                {{session('message')}}
                            </div>
                        @endif
                        @if($errors->any())
                            <div  id="errors" style="display: none" class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="list-style: none">{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                           <div class="col-2">
                                <img src="{{url('img/csSinFondo.png')}}"width="100px"height="100px;" alt=""style="padding: 5px">
                            </div>
                            <div class="col-10">
                                <h1 class="mt-4" style="padding-left: 15px">@yield('title')</h1>
                            </div>

                        </div>
                         <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                       @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Magestad {{date('Y')}}</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        @include('Shared.dialog')
       @include('Shared.script')
    </body>
</html>

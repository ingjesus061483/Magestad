<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{env('APP_NAME')}}&nbsp;-&nbsp;@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('resources/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
         <link rel="shortcut icon" type="image/x-icon" href="{{url('/favicon.ico')}}" />

    <!-- Custom styles for this template-->
    <link href="{{asset('resources/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">
 <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Custom fonts for this template-->
</head>

<body class="bg-gradient-primary">
     <input type="hidden" id="token" value="{{csrf_token()}}">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="container">
                        @if($errors->any())
                        <div id="errors" style="display: none" class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li style="list-style: none">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Nested Row within Card Body -->
                        @yield('content')
                    </div>
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Desea Salir?</h5>
                                         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                         </button>
                                 </div>
                                 <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <form  action="{{url('users/logout')}}"
                                        method="post">
                                        @csrf
                                        <button  title="Cerrar sesion" type="submit"  class="btn btn-primary">
                                            Cerrar sesion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('resources/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('resources/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('resources/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('resources/js/sb-admin-2.min.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            if ($("#errors").length>0)
            {
                Swal.fire({
                  title: "Login",
                  icon: "error",
                  html:$("#errors").html(),
                  draggable: true
                });

            }


        function ShowSubconfig(subModule)
        {
            $("#"+subModule).css('display','block');
            var button=$("#"+subModule).parent().find('button');
            $(button).css('color','#4e73df');
        }
        function HideSubconfig(subModule){

            $("#"+subModule).css('display','none');
            var button=$("#"+subModule).parent().find('button');
            $(button).css('color','gray');
       }
        function showSubmodule(subModule)
        {
            $(".module").fadeOut();
            $("#welcome-title").fadeOut();
            $("#return").fadeIn();
            $("#"+subModule).css('display','block');

        }
            function returnMenu(subModule)
            {
                $(".module").fadeIn();
                $("#welcome-title").fadeIn();
                $("#return").fadeOut();
                $(".subModule").css('display','none');

            }
    </script>

</body>

</html>

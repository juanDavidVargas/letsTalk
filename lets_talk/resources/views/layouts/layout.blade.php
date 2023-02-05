<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Let's Talk - @yield('title')</title>
    @yield('css')
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic' rel='stylesheet'
        type='text/css'>

    <!-- Styles -->
     {{-- <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.5.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/404.css') }}">

    {{-- Styles Login Entrenador --}}
    {{-- <link rel="icon" type="image/png" href="{{asset('favicon.ico')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('iconic/css/material-design-iconic-font.min.css')}}"> --}}
     <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
	{{-- <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}"> --}}
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">

    {{-- Sweetalert2 --}}
	<link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <!--  Js -->
    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="logo-box">
                <img src="{{asset('img/logo.png')}}" alt="logo" class="logo logo-img">
            </div>
        </div>

        @if(Request()->path() == '/' || Request()->path() == "login" ||
            Request()->path() == "login_estudiante")

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="sign-out">
                    &nbsp;
                </div>
            </div>
        @else

        {{-- Inicio Menu --}}
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="sign-out">
                {{-- Rol Entrenador (id = 1) --}}
                @if(!is_null(session('rol')) && (session('rol') == 1 || session('rol') == "1"))
                    <ul class="nav nav-tabs">
                        @if(Request()->path() == "trainer")
                            <li role="presentation">
                                <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
                            </li>
                            <li role="presentation"  class="active">
                                <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
                            </li>
                        @elseif(Request()->path() == "trainer/create")
                            <li role="presentation" class="active">
                                <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
                            </li>
                        @else
                            <li role="presentation" class="active">
                                <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
                            </li>
                            <li role="presentation">
                                <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('logout')}}" title="Cerrar Sesión">
                                <i class="fa fa-sign-out fa-3x" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                {{-- Rol Estudiante (id = 3) --}}
                @elseif(!is_null(session('rol')) && (session('rol') == 3 || session('rol') == "3"))
                    <ul class="nav nav-tabs">
                        @if(Request()->path() == "estudiante")
                            <li role="presentation" class="active">
                                <a href="#">Reservas</a>
                            </li>
                            <li role="presentation">
                                <a href="{{route('estudiante.disponibilidad')}}">Disponibilidad Entrenadores</a>
                            </li>
                        @else
                            <li role="presentation">
                                <a href="#">Reservas</a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="{{route('administrador.disponibilidad_entrenadores')}}">Disponibilidad Entrenadores</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('logout')}}" title="Cerrar Sesión">
                                <i class="fa fa-sign-out fa-3x" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                @else
                    {{-- Rol Administrador (id = 2) --}}
                    <ul class="nav nav-tabs">
                        @if(Request()->path() == "administrador")
                            <li role="presentation" class="active">
                                <a class="pointer" href="{{route('administrador.index')}}">Home</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('administrador.disponibilidad_entrenadores')}}">Availability Trainer's</a>
                            </li>

                            <li role="presentation">
                                <a href="#">Reservations</a>
                            </li>
                        @endif

                        @if(Request()->path() == "disponibilidad_entrenadores" && session('rol') == 2)

                            <li role="presentation">
                                <a class="pointer" href="{{route('administrador.index')}}">Home</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
                            </li>

                            <li role="presentation" class="active">
                                <a href="{{route('administrador.disponibilidad_entrenadores')}}">Availability Trainer's</a>
                            </li>
                            <li role="presentation">
                                <a href="#">Reservations</a>
                            </li>
                        @endif

                        @if(Request()->path() == "trainer/create")

                            <li role="presentation" class="active">
                                <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
                            </li>
                        @endif

                        @if(Request()->path() == "trainer")

                            <li role="presentation">
                                <a class="pointer" href="{{route('administrador.index')}}">Home</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('trainer.create')}}">Trainer's Agenda</a>
                            </li>

                            <li role="presentation" class="active">
                                <a href="{{route('trainer.index')}}">Trainer's Sessions</a>
                            </li>

                            <li role="presentation">
                                <a href="{{route('administrador.disponibilidad_entrenadores')}}">Availability Trainer's</a>
                            </li>

                            <li role="presentation">
                                <a href="#">Reservations</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('logout')}}" title="Cerrar Sesión">
                                <i class="fa fa-sign-out fa-3x" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
        {{-- Fin Menu --}}
        @endif
    </div>

    @yield('content')

    </div>

    <!-- Footer -->
    <footer class="text-center text-white footer">
        <!-- Grid container -->
        <div class="container">
            <!-- Section: Links -->
            <section class="mt-5">
                <!-- Grid row-->
                <div class="row text-center d-flex justify-content-center pt-5 padding">
                    <!-- Grid column -->
                    <div class="col-md-2 col-md-offset-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class="text-white">About us</a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class="text-white">Services</a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class="text-white">Help</a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class="text-white">Contact</a>
                        </h6>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row-->
            </section>
            <!-- Section: Links -->

            <hr class="my-5"/>

            <!-- Section: Text -->
            <section class="mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 col-lg-offset-2">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                            distinctio earum repellat quaerat voluptatibus placeat nam,
                            commodi optio pariatur est quia magnam eum harum corrupti
                            dicta, aliquam sequi voluptate quas.
                        </p>
                    </div>
                </div>
            </section>
            <!-- Section: Text -->

            <!-- Section: Social -->
            <section class="text-center mb-5">
                <a href="" class="text-white fa-2x facebook">
                    <i class="fa fa-facebook-f"></i>
                </a>
                <a href="" class="text-white fa-2x twitter">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="" class="text-white fa-2x google">
                    <i class="fa fa-google"></i>
                </a>
                <a href="" class="text-white fa-2x insta">
                    <i class="fa fa-instagram"></i>
                </a>
                <a href="" class="text-white fa-2x link">
                    <i class="fa fa-linkedin"></i>
                </a>
            </section>
            <!-- Section: Social -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3 copy-footer">
            <p>
                All Rights Reserved ©
                <a class="text-white" href="#">Let's Talk</a> {{date('Y')}}
            </p>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    @yield('scripts')
    <!-- SCRIPTS -->
    {{-- <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/homeslider.j') }}s"></script>
    <script src="{{ asset('js/jquery.grid-a-licious.js') }}"></script>
    <script src="{{ asset('js/404.js') }}"></script>

     {{-- Scripts Login Entrenador  --}}
	<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
	<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
	<script src="{{asset('js/main.js')}}"></script>

    {{-- Sweetalert --}}
	<script src="{{asset('js/sweetalert2.all.js')}}"></script>
	<script src="{{asset('js/sweetalert2.min.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>

    @include('sweetalert::alert')
</body>
</html>

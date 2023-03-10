@extends('layouts.layout')
@section('title', 'Create')
@section('css')
@stop
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h1 class="text-center text-uppercase">Create New User</h1>
    </div>
</div>

<div class="row m-b-30 m-t-30">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <a class="btn btn-warning" href="{{route('administrador.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</a>
    </div>
</div>

<hr>

{!! Form::open(['method' => 'POST', 'route' => ['administrador.store'], 'class' => 'login100-form validate-form', 'autocomplete' => 'off', 'id' => 'form_new_user']) !!}
@csrf

@include('administrador.fields')

{!! Form::close() !!}

@stop
@section('scripts')

<script>

    $( document ).ready(function()
    {
        $("#id_municipio_nacimiento").trigger('focus');
        $("#id_tipo_documento").trigger('focus');
        $("#numero_documento").trigger('focus');
        $("#id_municipio_nacimiento").trigger('focus');
        $("#fecha_nacimiento").trigger('focus');
        $("#estado").trigger('focus');
        $("#genero").trigger('focus');
        $("#id_municipio_residencia").trigger('focus');
        $("#id_rol").trigger('focus');
        $("#id_nivel").trigger('focus');
        $("#id_tipo_ingles").trigger('focus');

        let id_rol = $("#id_rol").val();

        if(id_rol == 3 || id_rol == "3")
        {
            $("#div_nivel").show('slow');
            $("#div_nivel").removeClass('ocultar');
            $("#div_tipo_ing").hide('slow');
            $("#div_tipo_ing").addClass('ocultar');

            $("#id_nivel").trigger('focus');

        } else {

            $("#div_nivel").hide('slow');
            $("#div_nivel").addClass('ocultar');
            $("#div_tipo_ing").show('slow');
            $("#div_tipo_ing").removeClass('ocultar');

            $("#id_tipo_ingles").trigger('focus');
        }
    });


    $("#numero_documento").blur(function(){

        let num_doc = $("#numero_documento").val();

        $.ajax({
            async: false,
            url: "{{route('validar_cedula')}}",
            type: "POST",
            dataType: "json",
            data: {'numero_documento': num_doc},
            success: function(response)
            {
                if(response == "existe_doc")
                {
                    $("#numero_documento").val('');

                    Swal.fire({
                        position: 'center',
                        title: 'Info!',
                        html:  'There is already a record with the document number entered!',
                        type: 'info',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey:false,
                        timer: 6000
                    });

                    return;
                }

                if(response == "error_exception")
                {
                    Swal.fire({
                        position: 'center',
                        title: 'Error!',
                        html:  'An error occurred, contact support!',
                        type: 'error',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey:false,
                        timer: 6000
                    });

                    return;
                }
            }
        });
    });

    $("#correo").blur(function(){

        let correo = $("#correo").val();

        $.ajax({
            async: false,
            url: "{{route('validar_correo')}}",
            type: "POST",
            dataType: "json",
            data: {'email': correo},
            success: function(response)
            {
                if(response == "existe_correo")
                {
                    $("#correo").val('');

                    Swal.fire({
                        position: 'center',
                        title: 'Info!',
                        html:  'A similar email already exists in our database!',
                        type: 'info',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey:false,
                        timer: 6000
                    });

                    return;
                }

                if(response == "error_exception_correo")
                {
                    Swal.fire({
                        position: 'center',
                        title: 'Error!',
                        html:  'An error occurred, contact support!',
                        type: 'error',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey:false,
                        timer: 6000
                    });

                    return;
                }
            }
        });
    });

    $("#id_rol").change(function()
    {
        let id_rol = $("#id_rol").val();

        if(id_rol == 3 || id_rol == "3")
        {
            $("#div_nivel").show('slow');
            $("#div_nivel").removeClass('ocultar');
            $("#div_tipo_ing").hide('slow');
            $("#div_tipo_ing").addClass('ocultar');

            $("#id_nivel").trigger('focus');

        } else {

            $("#div_nivel").hide('slow');
            $("#div_nivel").addClass('ocultar');
            $("#div_tipo_ing").show('slow');
            $("#div_tipo_ing").removeClass('ocultar');

            $("#id_tipo_ingles").trigger('focus');
        }
    });

</script>
@endsection

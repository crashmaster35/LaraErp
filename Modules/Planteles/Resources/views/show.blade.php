{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app')

{{-- Place the content of the main page of the module --}}
@section('content')
<style>
    .form-control-feedback {
        top: 30px;
    }
</style>
<div class="" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Planteles</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Datos del Plantel</h2>
                        <div style="float: right;"><a href="/planteles/" class="btn btn-round btn-primary">Regresar</a></div>
                        @if ($campus)
                            <div style="float: right;"><button class="btn btn-success" id="editaButton">Editar</button></div>
                        @endif
                        <div class="clearfix"></div>
                        <p>Datos generales del plantel</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open() !!}
                        @if ( $campus )
                            {!! Form::hidden('id', $campus->id) !!}
                            {!! Form::hidden('_method', 'POST') !!}
                        @else
                            {!! Form::hidden('_method', 'PUT') !!}
                        @endif
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="name">Nombre:</label>
                            {!! Form::text('name', $campus->name??'', ['class'=>'form-control has-feedback-left', 'id' => 'name']) !!}
                            <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="phone">Telefonos:</label>
                            {!! Form::text('phone', $campus->phone??'', ['class'=>'form-control has-feedback-left', 'id' => 'phone']) !!}
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="email">Correo Electrónico:</label>
                            {!! Form::text('email', $campus->email??'', ['class'=>'form-control has-feedback-left', 'id' => 'email']) !!}
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="whatsapp">WhatsApp:</label>
                            {!! Form::text('whatsapp', $campus->whatsapp??'', ['class'=>'form-control has-feedback-left', 'id' => 'whatsapp']) !!}
                            <span class="fa fa-comment form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="address">Dirección:</label>
                            {!! Form::textarea('address', $campus->address??'', ['class'=>'form-control', 'id' => 'address', 'data-parsley-trigger' => 'keyup', 'data-parsley-minlength' => '20', 'data-parsley-minlength-message' => 'Introduzca minimo 20 caracteres para la dirección.', 'placeholder' => 'Calle No., Colonia, Municipio, Estado, Pais, Codigo Postal.', 'rows' => '5']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align:center;">
                    <a href="/planteles/" class="btn btn-round btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-round btn-success" id="submit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if ($campus)
        $("#name").prop("readonly", true);
        $("#address").prop("readonly", true);
        $("#phone").prop("readonly", true);
        $("#email").prop("readonly", true);
        $("#whatsapp").prop("readonly", true);

        $('#editaButton').click(function(){
            $("#name").prop("readonly", false);
            $("#address").prop("readonly", false);
            $("#phone").prop("readonly", false);
            $("#email").prop("readonly", false);
            $("#whatsapp").prop("readonly", false);
        });
    @endif
});</script>
@endsection

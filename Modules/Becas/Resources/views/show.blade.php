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
                <h3>Precios</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Precios</h2>
                        <div style="float: right;"><a href="/becas/" class="btn btn-round btn-primary">Regresar</a></div>
                        @if ($becas)
                            <div style="float: right;"><button class="btn btn-success" id="editaButton">Editar</button></div>
                        @endif
                        <div class="clearfix"></div>
                        <p>Datos generales del precio</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open() !!}
                        @if ( $becas )
                            {!! Form::hidden('id', $becas->id) !!}
                            {!! Form::hidden('_method', 'POST') !!}
                        @else
                            {!! Form::hidden('_method', 'PUT') !!}
                        @endif
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="name">Nombre:</label>
                            {!! Form::text('name', $becas->name??'', ['class'=>'form-control has-feedback-left', 'id' => 'name']) !!}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="price">Precio:</label>
                            {!! Form::number('price', $becas->price??'', ['class'=>'form-control has-feedback-left', 'id' => 'price']) !!}
                            <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="type">Tipo de Precio:</label>
                            {!! Form::select('type', ['INSCRIPCION' => 'INSCRIPCION', 'MENSUALIDAD' => 'MENSUALIDAD', 'DESCUENTO' => 'DESCUENTO', 'OTRO' => 'OTRO'], $becas->type??'MENSUALIDAD', ['class' => 'form-control', 'id' => 'type']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="sign">Operación a Aplicar:</label>
                            {!! Form::select('sign', ['+' => '+', '-' => '-', '%' => '%', '=' => '='], $becas->sign??'=', ['class' => 'form-control', 'id' => 'sign']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align:center;">
                    <a href="/becas/" class="btn btn-round btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-round btn-success" id="submit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if ($becas)
        $("#name").prop("readonly", true);
        $("#price").prop("readonly", true);
        $("#type").prop("readonly", true);
        $("#type").prop("disabled", true);
        $("#sign").prop("readonly", true);
        $("#sign").prop("disabled", true);

        $('#editaButton').click(function(){
            $("#name").prop("readonly", false);
            $("#price").prop("readonly", false);
            $("#type").prop("readonly", false);
            $("#type").prop("disabled", false);
            $("#sign").prop("readonly", false);
            $("#sign").prop("disabled", false);
        });
    @endif
});</script>
@endsection

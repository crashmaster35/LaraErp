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
                <h3>Cursos</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Datos del Curso</h2>
                        <div style="float: right;"><a href="/cursos/" class="btn btn-round btn-primary">Regresar</a></div>
                        @if ($course)
                            <div style="float: right;"><button class="btn btn-success" id="editaButton">Editar</button></div>
                        @endif
                        <div class="clearfix"></div>
                        <p>Datos generales del curso</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open() !!}
                        @if ( $course )
                            {!! Form::hidden('id', $course->id) !!}
                            {!! Form::hidden('_method', 'POST') !!}
                        @else
                            {!! Form::hidden('_method', 'PUT') !!}
                        @endif
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="name">Nombre:</label>
                            {!! Form::text('name', $course->name??'', ['class'=>'form-control has-feedback-left', 'id' => 'name']) !!}
                            <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="length">Duración en meses:</label>
                            {!! Form::number('length', $course->length??'', ['class'=>'form-control has-feedback-left', 'id' => 'length']) !!}
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align:center;">
                    <a href="/cursos/" class="btn btn-round btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-round btn-success" id="submit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if ($course)
        $("#name").prop("readonly", true);
        $("#length").prop("readonly", true);

        $('#editaButton').click(function(){
            $("#name").prop("readonly", false);
            $("#length").prop("readonly", false);
        });
    @endif
});</script>
@endsection

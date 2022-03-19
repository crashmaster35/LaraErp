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
                <h3>Grupos</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Datos del Grupo</h2>
                        <div style="float: right;"><a href="/grupos/" class="btn btn-round btn-primary">Regresar</a></div>
                        @if ($group)
                            <div style="float: right;"><button class="btn btn-success" id="editaButton">Editar</button></div>
                        @endif
                        <div class="clearfix"></div>
                        <p>Datos generales del grupo</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open() !!}
                        @if ( $group )
                            {!! Form::hidden('id', $group->id) !!}
                            {!! Form::hidden('_method', 'POST') !!}
                        @else
                            {!! Form::hidden('_method', 'PUT') !!}
                        @endif
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="name">Nombre del Grupo (P. ej.: Grupo 1 - Matutino):</label>
                            {!! Form::text('name', $group->name??'', ['class'=>'form-control has-feedback-left', 'id' => 'name', 'required' => 'required']) !!}
                            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="campuses_id">Plantel asignado:</label>
                            {!! Form::select('campuses_id', $campuses, $group->campuses_id??'', ['class' => 'form-control', 'id' => 'campuses_id']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="courses_id">Plantel asignado:</label>
                            {!! Form::select('courses_id', $courses, $group->courses_id??'', ['class' => 'form-control', 'id' => 'courses_id']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="total">Máximo de Alumnos:</label>
                            {!! Form::number('total', $group->total??'', ['class'=>'form-control has-feedback-left', 'id' => 'total', 'required' => 'required', 'step' => '1']) !!}
                            <span class="fa fa-arrows-v form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="notes">Notas del grupo:</label>
                            {!! Form::textarea('notes', $group->notes??'', ['class'=>'form-control', 'id' => 'notes', 'data-parsley-trigger' => 'keyup', 'placeholder' => 'Introduzca cualquier situación respecto al grupo, alumnos, comportamiento, etc.', 'rows' => '5']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align:center;">
                    <a href="/grupos/" class="btn btn-round btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-round btn-success" id="submit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if ($group)
        $("#name").prop("readonly", true);
        $("#campuses_id").prop("readonly", true);
        $("#campuses_id").prop("disabled", true);
        $("#courses_id").prop("readonly", true);
        $("#courses_id").prop("disabled", true);
        $("#total").prop("readonly", true);
        $("#notes").prop("readonly", true);
        $("#notes").prop("disabled", true);

        $('#editaButton').click(function(){
            $("#name").prop("readonly", false);
            $("#campuses_id").prop("readonly", false);
            $("#campuses_id").prop("disabled", false);
            $("#courses_id").prop("readonly", false);
            $("#courses_id").prop("disabled", false);
            $("#total").prop("readonly", false);
            $("#notes").prop("readonly", false);
            $("#notes").prop("disabled", false);
        });
    @endif
});</script>
@endsection

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
                <h3>Materias</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Datos de la Materia</h2>
                        <div style="float: right;"><a href="/materias/curso/{{$cid}}/" class="btn btn-round btn-primary">Regresar</a></div>
                        @if ($classes)
                            <div style="float: right;"><button class="btn btn-success" id="editaButton">Editar</button></div>
                        @endif
                        <div class="clearfix"></div>
                        <p>Datos generales de la materia</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open() !!}
                        @if ( $classes )
                            {!! Form::hidden('id', $classes->id) !!}
                            {!! Form::hidden('course_id', $cid) !!}
                            {!! Form::hidden('_method', 'POST') !!}
                        @else
                            {!! Form::hidden('course_id', $cid) !!}
                            {!! Form::hidden('_method', 'PUT') !!}
                        @endif
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="name">Nombre:</label>
                            {!! Form::text('name', $classes->name??'', ['class'=>'form-control has-feedback-left', 'id' => 'name']) !!}
                            <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="hours">Horas clase:</label>
                            {!! Form::number('hours', $classes->hours??'', ['class'=>'form-control has-feedback-left', 'id' => 'hours']) !!}
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="period">Periodo:</label>
                            {!! Form::select('period', ['SEMESTRE' => 'SEMESTRE', 'TETRAMESTRE' => 'TETRAMESTRE', 'TRIMESTRE' => 'TRIMESTRE'], $classes->period??'TRIMESTRE', ['class' => 'form-control', 'id' => 'period']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="what_period">¿En que periodo se presenta?:</label>
                            {!! Form::number('what_period', $classes->what_period??'', ['class'=>'form-control has-feedback-left', 'id' => 'what_period']) !!}
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align:center;">
                    <a href="/materias/curso/{{$cid}}/" class="btn btn-round btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-round btn-success" id="submit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if ($classes)
        $("#name").prop("readonly", true);
        $("#hours").prop("readonly", true);
        $("#period").prop("readonly", true);
        $("#period").prop("disabled", true);
        $("#what_period").prop("readonly", true);


        $('#editaButton').click(function(){
            $("#name").prop("readonly", false);
            $("#hours").prop("readonly", false);
            $("#period").prop("readonly", false);
            $("#period").prop("disabled", false);
            $("#what_period").prop("readonly", false);
        });
    @endif
});</script>
@endsection

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
                <h3>Alumnos</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Datos Generales</h2>
                        <div style="float: right;"><a href="/alumnos/" class="btn btn-round btn-primary">Regresar</a></div>
                        @if ($student)
                            <div style="float: right;"><button class="btn btn-success" id="editaButton">Editar</button></div>
                            @if ($student->matricula == null)
                                @if (Module::isEnabled('Inscripciones'))
                                    <div style="float: right;"><a href="/inscripciones/{{ $student->id }}" class="btn btn-warning" style="color:black;">Inscribir Alumno</a></div>
                                @endif
                            @endif
                            @if (Module::isEnabled('Pagos'))
                                <div style="float: right;"><a href="/pagos/{{ $student->id }}/" class="btn btn-dark" style="color:white;">Ver Pagos</a></div>
                            @endif
                        @endif
                        <div class="clearfix"></div>
                        <p>Datos generales del alumno</p>
                        <div style="float:right; font-size:28px">MATRICULA: <span style="color:red">{!! $student->matricula??'NO INSCRITO' !!}</span></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open() !!}
                        @if ( $student )
                            {!! Form::hidden('id', $student->id) !!}
                            {!! Form::hidden('_method', 'POST') !!}
                        @else
                            {!! Form::hidden('_method', 'PUT') !!}
                        @endif
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="nombres">Nombre(s):</label>
                            {!! Form::text('nombres', $student->nombres??'', ['class'=>'form-control has-feedback-left', 'id' => 'nombres']) !!}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="ap_paterno">Apellido Paterno:</label>
                            {!! Form::text('ap_paterno', $student->ap_paterno??'', ['class'=>'form-control has-feedback-left', 'id' => 'ap_paterno']) !!}
                            <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="ap_materno">Apellido Materno:</label>
                            {!! Form::text('ap_materno', $student->ap_materno??'', ['class'=>'form-control has-feedback-left', 'id' => 'ap_materno']) !!}
                            <span class="fa fa-female form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4 ">
                            <label for="fecha_nac">Fecha de Nacimiento (dd-mm-aaaa):</label>
                            <input id="fecha_nac" name="fecha_nac" class="date-picker form-control has-feedback-left" placeholder="dd-mm-aaaa" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='date'" onmouseout="timeFunctionLong(this)" value="{{ ($student->fecha_nac)??'' }}">
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function() {
                                        input.type = 'date';
                                    }, 60000);
                                }
                            </script>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="lugar_nac">Lugar de Nacimiento:</label>
                            {!! Form::text('lugar_nac', $student->lugar_nac??'', ['class'=>'form-control has-feedback-left', 'id' => 'lugar_nac']) !!}
                            <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="nacionalidad">Nacionalidad:</label>
                            {!! Form::select('nacionalidad', ['MEXICANA' => 'MEXICANA', 'EXTRANGERA' => 'EXTRANGERA'], $student->nacionalidad??'MEXICANA', ['class' => 'form-control', 'id' => 'nacionalidad']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="nacionalidad_ext">Si es extranjero, ¿Que nacionalidad tiene?:</label>
                            {!! Form::text('nacionalidad_ext', $student->nacionalidad_ext??'', ['class'=>'form-control has-feedback-left', 'id' => 'nacionalidad_ext']) !!}
                            <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="anos_cumplidos">Años Cumplidos:</label>
                            {!! Form::number('anos_cumplidos', $student->anos_cumplidos??'', ['class'=>'form-control has-feedback-left', 'id' => 'anos_cumplidos']) !!}
                            <span class="fa fa-heart form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="ciudad">Ciudad donde radica:</label>
                            {!! Form::text('ciudad', $student->ciudad??'', ['class'=>'form-control has-feedback-left', 'id' => 'ciudad']) !!}
                            <span class="fa fa-flag form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="direccion">Dirección:</label>
                            {!! Form::textarea('direccion', $student->direccion??'', ['class'=>'form-control', 'id' => 'direccion', 'data-parsley-trigger' => 'keyup', 'data-parsley-minlength' => '20', 'data-parsley-minlength-message' => 'Introduzca minimo 20 caracteres para la dirección.', 'placeholder' => 'Calle No., Colonia, Municipio, Estado, Pais, Codigo Postal.', 'rows' => '5']) !!}
                        </div>
                        <div class="clearfix"></div>
                        <div class="x_title">
                            <h2>Datos de Contacto</h2>
                            <div class="clearfix"></div>
                            <p>Información para contactar al alumno o a su tutor legal.</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="email">Correo Electrónico:</label>
                            {!! Form::email('email', $student->email??'', ['class'=>'form-control has-feedback-left', 'id' => 'email']) !!}
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="celular">Teléfono Celular:</label>
                            {!! Form::text('celular', $student->celular??'', ['class'=>'form-control has-feedback-left', 'id' => 'celular']) !!}
                            <span class="fa fa-mobile form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="tel_casa">Teléfono de Casa:</label>
                            {!! Form::text('tel_casa', $student->tel_casa??'', ['class'=>'form-control has-feedback-left', 'id' => 'tel_casa']) !!}
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="x_title">
                            <h2>Medidas</h2>
                            <div class="clearfix"></div>
                            <p>Información de talla y peso para el uniforme.</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="peso">Peso en Kg.:</label>
                            {!! Form::number('peso', $student->peso??'', ['class'=>'form-control has-feedback-left', 'id' => 'peso', 'step' => '0.01']) !!}
                            <span class="fa fa-align-center form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="altura">Estatura en mts.:</label>
                            {!! Form::number('altura', $student->altura??'', ['class'=>'form-control has-feedback-left', 'id' => 'altura', 'step' => '0.01']) !!}
                            <span class="fa fa-list-ol form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="talla_pantalon">Talla de pantalón:</label>
                            {!! Form::number('talla_pantalon', $student->talla_pantalon??'', ['class'=>'form-control has-feedback-left', 'id' => 'talla_pantalon']) !!}
                            <span class="fa fa-arrows-v form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="talla_playera">Talla de Playera:</label>
                            {!! Form::select('talla_playera', ['CHICO' => 'CHICO', 'MEDIANO' => 'MEDIANO', 'GRANDE' => 'GRANDE', 'EXTRA GRANDE' => 'EXTRA GRANDE'], ($student->talla_playera)??'MEDIANO', ['class' => 'form-control', 'id' => 'talla_playera']) !!}
                        </div>
                        <div class="clearfix"></div>
                        <div class="x_title">
                            <h2>Antecedentes Educativos</h2>
                            <div class="clearfix"></div>
                            <p>Información de estudios previos.</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="secundaria">Nombre de la Secundaria donde estudió (certificado):</label>
                            {!! Form::text('secundaria', $student->secundaria??'', ['class'=>'form-control has-feedback-left', 'id' => 'secundaria']) !!}
                            <span class="fa fa-institution form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="secu_dir">Dirección de la secundaria donde estudio:</label>
                            {!! Form::textarea('secu_dir', $student->secu_dir??'', ['class'=>'form-control', 'id' => 'secu_dir', 'data-parsley-trigger' => 'keyup', 'data-parsley-minlength' => '20', 'data-parsley-minlength-message' => 'Introduzca minimo 20 caracteres para la dirección.', 'placeholder' => 'Calle No., Colonia, Municipio, Estado, Pais, Codigo Postal.', 'rows' => '5']) !!}
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="preparatoria">Nombre de la preparatoria donde estudió (certificado):</label>
                            {!! Form::text('preparatoria', $student->preparatoria??'', ['class'=>'form-control has-feedback-left', 'id' => 'preparatoria']) !!}
                            <span class="fa fa-institution form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="prepa_dir">Dirección de la preparatoria donde estudio:</label>
                            {!! Form::textarea('prepa_dir', $student->prepa_dir??'', ['class'=>'form-control', 'id' => 'prepa_dir', 'data-parsley-trigger' => 'keyup', 'data-parsley-minlength' => '20', 'data-parsley-minlength-message' => 'Introduzca minimo 20 caracteres para la dirección.', 'placeholder' => 'Calle No., Colonia, Municipio, Estado, Pais, Codigo Postal.', 'rows' => '5']) !!}
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="universidad">Nombre de la universidad donde estudió (certificado):</label>
                            {!! Form::text('universidad', $student->universidad??'', ['class'=>'form-control has-feedback-left', 'id' => 'universidad']) !!}
                            <span class="fa fa-institution form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="uni_dir">Dirección de la universidad donde estudio:</label>
                            {!! Form::textarea('uni_dir', $student->uni_dir??'', ['class'=>'form-control', 'id' => 'uni_dir', 'data-parsley-trigger' => 'keyup', 'data-parsley-minlength' => '20', 'data-parsley-minlength-message' => 'Introduzca minimo 20 caracteres para la dirección.', 'placeholder' => 'Calle No., Colonia, Municipio, Estado, Pais, Codigo Postal.', 'rows' => '5']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="licenciatura">En caso de haber cursado una licenciatura indique ¿Cual?:</label>
                            {!! Form::text('licenciatura', $student->licenciatura??'', ['class'=>'form-control has-feedback-left', 'id' => 'licenciatura']) !!}
                            <span class="fa fa-graduation-cap form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="x_title">
                            <h2>Padre o Tutor</h2>
                            <div class="clearfix"></div>
                            <p>Datos del padre o tutor en caso de ser menor de edad o vivir con ellos. Estudio socioeconómico</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="nombre_rep">Nombre del Padre, Made o representante legal:</label>
                            {!! Form::text('nombre_rep', $student->nombre_rep??'', ['class'=>'form-control has-feedback-left', 'id' => 'nombre_rep']) !!}
                            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="ident">Numero de la identificación IFE:</label>
                            {!! Form::text('ident', $student->ident??'', ['class'=>'form-control has-feedback-left', 'id' => 'ident']) !!}
                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="parentesco">Parentesco:</label>
                            {!! Form::select('parentesco', ['PADRE' => 'PADRE', 'MADRE' => 'MADRE', 'ABUELO' => 'ABUELO', 'ABUELA' => 'ABUELA', 'SIN PARENTESCO' => 'SIN PARENTESCO', 'OTRO PARENTESCO' => 'OTRO PARENTESCO'], ($student->parentesco)??'MADRE', ['class' => 'form-control', 'id' => 'parentesco']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="ocup_rep">Ocupación:</label>
                            {!! Form::select('ocup_rep', ['EMPLEADO PUBLICO' => 'EMPLEADO PUBLICO', 'EMPLEADO PRIVADO' => 'EMPLEADO PRIVADO', 'AUTONOMO' => 'AUTONOMO', 'JUBILADO' => 'JUBILADO', 'NO TRABAJA' => 'NO TRABAJA'], ($student->ocup_rep)??'EMPLEADO PRIVADO', ['class' => 'form-control', 'id' => 'ocup_rep']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="estudios_rep">Nivel Educativo:</label>
                            {!! Form::select('estudios_rep', ['ANALFABETO' => 'ANALFABETO', 'CURSOS EXTRAESCOLARES' => 'CURSOS EXTRAESCOLARES', 'PRIMARIA INCOMPLETA' => 'PRIMARIA INCOMPLETA', 'PRIMARIA COMPLETA' => 'PRIMARIA COMPLETA', 'SECUNDARIA INCOMPLETA' => 'SECUNDARIA INCOMPLETA', 'SECUNDARIA COMPLETA' => 'SECUNDARIA COMPLETA', 'PREPARATORIA INCOMPLETA' => 'PREPARATORIA INCOMPLETA', 'PREPARATORIA COMPLETA' => 'PREPARATORIA COMPLETA', 'UNIVERSIDAD INCOMPLETA' => 'UNIVERSIDAD INCOMPLETA', 'UNIVERSIDAD COMPLETA' => 'UNIVERSIDAD COMPLETA', 'POSGRADO INCOMPLETO' => 'POSGRADO INCOMPLETO', 'POSGRADO COMPLETO' => 'POSGRADO COMPLETO'], ($student->estudios_rep)??'PREPARATORIA COMPLETA', ['class' => 'form-control', 'id' => 'estudios_rep']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="estudio_economico">Nivel Socioeconómico:</label>
                            {!! Form::select('estudio_economico', ['MUY BUENA' => 'MUY BUENA', 'BUENA' => 'BUENA', 'REGULAR' => 'REGULAR', 'MALA' => 'MALA'], $student->estudio_economico??'BUENA', ['class' => 'form-control', 'id' => 'estudio_economico']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="vivienda">Vivienda:</label>
                            {!! Form::select('vivienda', ['PROPIA' => 'PROPIA', 'RENTADA' => 'RENTADA', 'PRESTADA' => 'PRESTADA'], ($student->vivienda)??'PROPIA', ['class' => 'form-control', 'id' => 'vivienda']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align:center;">
                    <a href="/alumnos/" class="btn btn-round btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-round btn-success" id="submit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if ($student)
        $("#nombres").prop("readonly", true);
        $("#ap_paterno").prop("readonly", true);
        $("#ap_materno").prop("readonly", true);
        $("#fecha_nac").prop("readonly", true);
        $("#lugar_nac").prop("readonly", true);
        $("#nacionalidad").prop("readonly", true);
        $("#nacionalidad").prop("disabled", true);
        $("#nacionalidad_ext").prop("readonly", true);
        $("#anos_cumplidos").prop("readonly", true);
        $("#ciudad").prop("readonly", true);
        $("#direccion").prop("readonly", true);
        $("#email").prop("readonly", true);
        $("#celular").prop("readonly", true);
        $("#tel_casa").prop("readonly", true);
        $("#peso").prop("readonly", true);
        $("#altura").prop("readonly", true);
        $("#talla_pantalon").prop("readonly", true);
        $("#talla_playera").prop("readonly", true);
        $("#secundaria").prop("readonly", true);
        $("#secu_dir").prop("readonly", true);
        $("#preparatoria").prop("readonly", true);
        $("#prepa_dir").prop("readonly", true);
        $("#universidad").prop("readonly", true);
        $("#uni_dir").prop("readonly", true);
        $("#licenciatura").prop("readonly", true);
        $("#nombre_rep").prop("readonly", true);
        $("#ident").prop("readonly", true);
        $("#parentesco").prop("readonly", true);
        $("#ocup_rep").prop("readonly", true);
        $("#estudios_rep").prop("readonly", true);
        $("#estudio_economico").prop("readonly", true);
        $("#vivienda").prop("readonly", false);
        $("#submit").prop("disabled", true);
        $("#parentesco").prop("disabled", true);
        $("#talla_playera").prop("disabled", true);
        $("#ocup_rep").prop("disabled", true);
        $("#estudios_rep").prop("disabled", true);
        $("#estudio_economico").prop("disabled", true);
        $("#vivienda").prop("disabled", true);

        $('#editaButton').click(function(){
            $("#nombres").prop("readonly", false);
            $("#ap_paterno").prop("readonly", false);
            $("#ap_materno").prop("readonly", false);
            $("#fecha_nac").prop("readonly", false);
            $("#lugar_nac").prop("readonly", false);
            $("#nacionalidad").prop("readonly", false);
            $("#nacionalidad").prop("disabled", false);
            $("#nacionalidad_ext").prop("readonly", false);
            $("#anos_cumplidos").prop("readonly", false);
            $("#ciudad").prop("readonly", false);
            $("#direccion").prop("readonly", false);
            $("#email").prop("readonly", false);
            $("#celular").prop("readonly", false);
            $("#tel_casa").prop("readonly", false);
            $("#peso").prop("readonly", false);
            $("#altura").prop("readonly", false);
            $("#talla_pantalon").prop("readonly", false);
            $("#talla_playera").prop("readonly", false);
            $("#talla_playera").prop("disabled", false);
            $("#secundaria").prop("readonly", false);
            $("#secu_dir").prop("readonly", false);
            $("#preparatoria").prop("readonly", false);
            $("#prepa_dir").prop("readonly", false);
            $("#universidad").prop("readonly", false);
            $("#uni_dir").prop("readonly", false);
            $("#licenciatura").prop("readonly", false);
            $("#nombre_rep").prop("readonly", false);
            $("#ident").prop("readonly", false);
            $("#parentesco").prop("readonly", false);
            $("#parentesco").prop("disabled", false);
            $("#talla_playera").prop("disabled", false);
            $("#ocup_rep").prop("readonly", false);
            $("#ocup_rep").prop("disabled", false);
            $("#estudios_rep").prop("readonly", false);
            $("#estudios_rep").prop("disabled", false);
            $("#estudio_economico").prop("readonly", false);
            $("#estudio_economico").prop("disabled", false);
            $("#vivienda").prop("readonly", false);
            $("#vivienda").prop("disabled", false);
            $("#submit").prop("disabled", false);
        });
    @endif
});</script>
@endsection

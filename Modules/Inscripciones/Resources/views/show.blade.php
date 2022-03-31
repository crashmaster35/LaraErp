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
                <h3>Inscripcion del Alumno: <span style="color:red">{{ $student->nombres }} {{ $student->ap_paterno }} {{ $student->ap_materno }}</span></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div id="wizard_verticle1" class="form_wizard wizard_verticle">
                            <ul class="list-unstyled wizard_steps">
                                <li>
                                    <a href="#step-1">
                                        <span class="step_no">1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <span class="step_no">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <span class="step_no">3</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-4">
                                        <span class="step_no">4</span>
                                    </a>
                                </li>
                            </ul>
                            <div id="step-1">
                                <br/><br/>
                                <h2 class="StepTitle">Seleccione Plantel</h2>
                                <br/><br/><br/><br/><br/>
                                <div class="clearfix"></div>
                                <p>Dentro de la siguiente lista busca el plantel en el que el alumno desea inscribirse.</p>
                                <p>Asegurate que sea el plantel correcto antes de continuar con el proceso de inscripción.</p>  
                                <div class="clearfix"></div>
                                <form class="form-horizontal form-label-left">       
                                    <div class="col-md-4 col-sm-4  form-group has-feedback">
                                        <label for="campuses_id"></label>
                                        {!! Form::select('campuses_id', $campuses, null, ['class' => 'form-control', 'id' => 'campuses_id']) !!}
                                    </div>       
                                </form>
                                <div class="clearfix"></div>
                                <br/><br/><br/><br/><br/>
                            </div>
                            <div id="step-2">
                                <br/><br/>
                                <h2 class="StepTitle">Seleccione Curso</h2>
                                <br/><br/><br/><br/><br/>
                                <div class="clearfix"></div>
                                <p>Dentro de la siguiente lista busca el curso en el que el alumno desea inscribirse.</p>
                                <p>Asegurate que sea el curso correcto antes de continuar con el proceso de inscripción.</p>  
                                <div class="clearfix"></div>
                                <form class="form-horizontal form-label-left">       
                                    <div class="col-md-4 col-sm-4  form-group has-feedback">
                                        <label for="course_id"></label>
                                        {!! Form::select('course_id', $courses, null, ['class' => 'form-control', 'id' => 'course_id']) !!}
                                    </div>       
                                </form>
                                <div class="clearfix"></div>
                                <br/><br/><br/><br/><br/>
                            </div>
                            <div id="step-3">
                                <h2 class="StepTitle">Seleccione Grupo</h2>
                                <br/><br/><br/><br/><br/>
                                <div class="clearfix"></div>
                                <p>Espera a que carge la lista de grupos que corresponden al plantel y curso seleccionados.</p>
                                <p>Selecciona el grupo al que desea inscribrse el alumno y asegurate que sea el correcto. El numero entre parentesis significa los lugares disponibles.</p>  
                                <div class="clearfix"></div>
                                <form class="form-horizontal form-label-left">       
                                    <div class="col-md-4 col-sm-4  form-group has-feedback">
                                        <label for="group_id">Grupo Seleccionado:</label>
                                        {!! Form::select('group_id', ['0' => 'Cargando...'], null, ['class' => 'form-control', 'id' => 'group_id']) !!}
                                    </div>       
                                </form>
                                <div class="clearfix"></div>
                                <br/><br/><br/><br/><br/>
                            </div>
                            <div id="step-4">
                                <h2 class="StepTitle">¿Esta seguro de inscribir al alumno en ese grupo?</h2>
                                <div class="clearfix"></div>
                                <form class="form-horizontal form-label-left">       
                                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                                        <p>Asegurese que los datos que introdujo sean los correctos</p>
                                        <p>El Alumno se encontrará inscrito en:</p>
                                        <p style="color:black; font-size:18px;font-weight:400">Plantel: <span id="plantel" style="color: red;font-size: 28px;font-weight: bolder;"></span></p>
                                        <p style="color:black; font-size:18px;font-weight:400">Curso: <span id="curso" style="color: red;font-size: 28px;font-weight: bolder;"></span></p>
                                        <p style="color:black; font-size:18px;font-weight:400">Grupo: <span id="grupo" style="color: red;font-size: 28px;font-weight: bolder;"></span></p>
                                    </div>       
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery Smart Wizard -->
<script src="/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
$(document).ready(function(){
    var campus;
    var course;
    var idcampus;
    var idcourse;
    var idgroup;
    $('#wizard_verticle1').smartWizard({
        selected:0,
        cycleSteps:false,
        transitionEffect: 'slideleft',
        hideButtonsOnDisabled: false,
        labelNext:'Adelante',
        labelPrevious:'Atras',
        labelFinish:'Terminar',
        onLeaveStep:leaveAStepCallback,
        onFinish:onFinishCallback,
        noForwardJumping: true
    });

    function leaveAStepCallback(obj, context){
        return validateSteps(context.fromStep); 
    }

    function onFinishCallback(objs, context){
        if(validateAllSteps()){
            $('form').submit();
        }
    }

    // Your Step validation logic
    function validateSteps(stepnumber){
        var isStepValid = true;
        if(stepnumber == 1){
            campus = $('#campuses_id').find(":selected").text();
            idcampus = $('#campuses_id').find(":selected").val();
            $('#plantel').text(campus)
            return true
        }
        if (stepnumber == 2) {
            course = $('#course_id').find(":selected").text();
            idcourse = $('#course_id').find(":selected").val();
            $('#curso').text(course)
            $.ajax({
                url: "/inscripciones/getGroup",
                dataType: 'json',
                type: 'POST',
                data:{idcampus: idcampus, idcourse: idcourse, _token: "{{csrf_token()}}"},
                success: function(result) {
                    var $select = $('#group_id');
                    $select.html('');
                    $.each(result, function(key, value) {
                        $select.append(`<option value="${key}">${value}</option>`);
                    })

                    return true
                }

            });
            return true
        }
        if (stepnumber == 3) {
            group = $('#group_id').find(":selected").text();
            idgroup = $('#group_id').find(":selected").val();
            $('#grupo').text(group)
            bootbox.confirm("¿Estas seguro de registrar al alumno en ese grupo?", function(result){ 
                if (result) {
                    $.ajax({
                        url: "/inscripciones/{{$student->id}}/inscribir",
                        dataType: 'json',
                        type: 'post',
                        data:{idcourse: idcourse, idgroup: idgroup, idstudent: {{$student->id}}, _token: "{{csrf_token()}}"},
                        success: function(result) {
                            if (result.error) {
                                bootbox.alert(result.msg, function(){ 
                                    location.href="/inscripciones";
                                });
                            } else {
                                bootbox.alert(result.msg, function(){ 
                                    location.href="/inscripciones";
                                });
                            }
                        }
                    });
                } else {
                    bootbox.alert('No registrado, revise la información');
                }
            });


            return true
        }
        if (stepnumber == 4) {

            return true
        }
    }
    function validateAllSteps(){
        var isStepValid = true;
        return isStepValid;
    }          

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

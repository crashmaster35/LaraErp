{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app')

{{-- Place the content of the main page of the module --}}
@section('content')
<div class="" role="main">
    <div class="clearfix"></div>
    @if (session('errormsg'))
        <div class="">
            <div class="alert alert-danger" role="alert error">{{ session()->get('errormsg') }}</div>
        </div>
    @endif
    @if (session('successmsg'))
        <div class="">
            <div class="alert alert-success" role="alert success">{{ session()->get('successmsg') }}</div>
        </div>
    @endif
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>¿Esta seguro de dar de baja al alumno?</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Alumnado</h2>
                                <div style="float: right;"><a href="/bajas/" class="btn btn-round btn-primary">Regresar</a></div>
                                <div class="clearfix"></div>
                                <p>Dar de baja al alumno de un grupo</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-12 x_title">
                                    <h3>Datos del alumno:</h3>
                                </div>
                                <div class="col-md-12">
                                    Nombre: <span style="color:red; font-size:18px;font-weight:400">{{$student->nombres}} {{$student->ap_paterno}} {{$student->ap_materno}}</span>
                                </div>
                                <div class="col-md-12">
                                    Matricula: <span style="color:red; font-size:18px;font-weight:400">{{$student->matricula}}</span>
                                </div>
                                <div class="col-md-12">
                                    Carrera: <span style="color:red; font-size:18px;font-weight:400">{{$student->carrera}}</span>
                                </div>
                                <div class="col-md-12">
                                    Grupo: <span style="color:red; font-size:18px;font-weight:400">{{$student->grupo}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="clearfix"></div>
                            <div class="x_content">
                                <div style="float: right;"><a href="/bajas/{{ $student->rid }}/baja" class="btn btn-warning" style="color:black;">¿Está seguro de dar de baja del grupo al alumno?</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

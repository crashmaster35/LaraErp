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
                <h3>Alumnos</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">No Matriculados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Matriculados</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Alumnado Sin Matricula</h2>
                                <div style="float: right;"><a href="/alumnos/registro" class="btn btn-info" style="color:white;">Registrar Alumno</a></div>
                                <div class="clearfix"></div>
                                <p>Altas, Bajas y Modificaciones de alumnos</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @component('components.datatables.datatable', $dtObjectAlumnos)
                                @endcomponent
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Alumnado Con Matricula</h2>
                                <div class="clearfix"></div>
                                <p>Altas, Bajas y Modificaciones de alumnos</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @component('components.datatables.datatable', $dtObjectAlumnosMat)
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

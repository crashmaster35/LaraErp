{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app')

{{-- Place the content of the main page of the module --}}
@section('content')
<div class="" role="main">
    <div class="clearfix"></div>
    @if (!Module::isEnabled('Planteles') && !Module::isEnabled('Cursos'))
        <div class="">
            <div class="alert alert-danger" role="alert error">Se requiere que estén instalados y configurados los módulos de Planteles y Cursos.</div>
        </div>
    @endif
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
    @if (Module::isEnabled('Planteles') && Module::isEnabled('Cursos'))
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Grupos</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Grupos</h2>
                                <div style="float: right;"><a href="/grupos/registro" class="btn btn-info" style="color:white;">Registrar grupo</a></div>
                                <div class="clearfix"></div>
                                <p>Altas, Bajas y Modificaciones de Grupos</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @component('components.datatables.datatable', $dtObjectGroups)
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

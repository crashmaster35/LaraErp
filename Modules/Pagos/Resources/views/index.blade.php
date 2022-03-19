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
            <h3>Pagos del Alumno <span style="color:green;"> {{ $student->nombres }} {{ $student->ap_paterno }} {{ $student->ap_materno }} </span> -  Mat: <span style="color:red;"> {{ $student->matricula??'Alumno No Inscrito' }}</span></h3>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="tab-content" id="myTabContent">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Pagos Registrados</h2>
                            <div style="float: right;"><a href="/pagos/{{ $id }}/registro" class="btn btn-info" style="color:white;">Registrar Pago</a></div>
                            <div class="clearfix"></div>
                            <p>Ingreso de pagos por transferencia o deposito bancario.</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @component('components.datatables.datatable', $dtObjectPayments)
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

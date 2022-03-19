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
                <h3>Registrar Pago</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Datos del Deposito o Tranferencia</h2>
                        <div style="float: right;"><a href="/pagos/{{ $id }}/" class="btn btn-round btn-primary">Regresar</a></div>
                        @if ($pagos)
                            <div style="float: right;"><button class="btn btn-success" id="editaButton">Editar</button></div>
                        @endif
                        <div class="clearfix"></div>
                        <p>Datos generales de la transferencia realizada.</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open() !!}
                        @if ( $pagos )
                            {!! Form::hidden('id', $pagos->id) !!}
                            {!! Form::hidden('_method', 'POST') !!}
                        @else
                            {!! Form::hidden('_method', 'PUT') !!}
                        @endif
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="type">Tipo de Pago:</label>
                            {!! Form::select('type', ['INSCRIPCION' => 'INSCRIPCION', 'MENSUALIDAD' => 'MENSUALIDAD', 'EXAMEN EXTRAORDINARIO' => 'EXAMEN EXTRAORDINARIO', 'BLS' => 'BLS', 'PHTLS' => 'PHTLS', 'IPR' => 'IPR', 'OTROS' => 'OTROS'], $pagos->type??'MENSUALIDAD', ['class' => 'form-control', 'id' => 'type']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="bank">Banco emisor:</label>
                            {!! Form::text('bank', $pagos->bank??'', ['class'=>'form-control has-feedback-left', 'id' => 'bank']) !!}
                            <span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="amount">Total del Deposito o Transferencia:</label>
                            {!! Form::number('amount', $pagos->amount??'', ['class'=>'form-control has-feedback-left', 'id' => 'amount', 'step' => '0.01']) !!}
                            <span class="fa fa-usd form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="transaction">No. de Transacción (Pueden ser letras/numeros):</label>
                            {!! Form::text('transaction', $pagos->transaction??'', ['class'=>'form-control has-feedback-left', 'id' => 'transaction']) !!}
                            <span class="fa fa-exchange form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label for="transaction_date">Fecha de la Transacción (dd-mm-aaaa):</label>
                            <input id="transaction_date" name="transaction_date" class="date-picker form-control has-feedback-left" placeholder="dd-mm-aaaa" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='date'" onmouseout="timeFunctionLong(this)" value="{{ ($pagos->transaction_date)??'' }}" data-inputmask="'mask': '99/99/9999'">
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
                            <label for="transaction_time">Hora de la Transacción:</label>
                            {!! Form::time('transaction_time', $pagos->transaction_time??'', ['class'=>'form-control has-feedback-left', 'id' => 'transaction_time']) !!}
                            <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4  form-group has-feedback">
                            <label for="notes">Detalles de la transacción:</label>
                            {!! Form::textarea('notes', $pagos->notes??'', ['class'=>'form-control', 'id' => 'notes', 'data-parsley-trigger' => 'keyup', 'placeholder' => 'Indique todos los datos de la ficha de deposito.', 'rows' => '5']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align:center;">
                    <a href="/pagos/{{ $id }}" class="btn btn-round btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-round btn-success" id="submit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if ($pagos)
        $("#type").prop("readonly", true);
        $("#amount").prop("readonly", true);
        $("#transaction").prop("readonly", true);
        $("#transaction_date").prop("readonly", true);
        $("#transaction_time").prop("readonly", true);

        $('#editaButton').click(function(){
            $("#type").prop("readonly", false);
            $("#amount").prop("readonly", false);
            $("#transaction").prop("readonly", false);
            $("#transaction_date").prop("readonly", false);
            $("#transaction_time").prop("readonly", false);
        });
    @endif
});</script>
@endsection

{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app') 

{{-- Place the content of the main page of the module --}}
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Almacenes</h1>

    <p>Esta es la configuración del módulo: {!! config('warehouse.name') !!}. Modifique los valores con respecto a sus necesidades. Para algunas opciones deberá estar activo los modulos de Clientes y Punto de Venta</p>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reglas de Inventarios</h2>
            <div class="clearfix"></div>
            <p>Configuración para el decremento, aumento y configuración del inventario de forma automática</p>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            {!! Form::open(['url' => 'warehouse/settings', 'method' => 'post', 'class' => 'form-horizontal form-label-left'])!!}
              <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align" for="decrement_stock_clients">Decrementar el stock en almacén cuando se cierre una factura a cliente</label>
                <div class="col-md-2 col-sm-2 ">
                  <label>
                    @if ($config)
                      @if ($config->decrement_stock_clients == '1')
                        <input type="checkbox" class="js-switch" name="decrement_stock_clients" checked /> 
                      @else
                        <input type="checkbox" class="js-switch" name="decrement_stock_clients" /> 
                      @endif
                    @else
                      <input type="checkbox" class="js-switch" name="decrement_stock_clients" checked /> 
                    @endif
                  </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align" for="increment_stock_providers">Incrementar el stock en almacén cuando realice la recepción de pedido del proveedor</label>
                <div class="col-md-2 col-sm-2 ">
                  <label>
                    @if ($config)
                      @if ($config->increment_stock_providers == '1')
                        <input type="checkbox" class="js-switch" name="increment_stock_providers" checked /> 
                      @else
                        <input type="checkbox" class="js-switch" name="increment_stock_providers" /> 
                      @endif
                    @else
                      <input type="checkbox" class="js-switch" name="increment_stock_providers" checked /> 
                    @endif
                  </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align" for="negative_stock">Permitir stock negativo</label>
                <div class="col-md-2 col-sm-2 ">
                  <label>
                    @if ($config)
                      @if ($config->negative_stock == '1')
                        <input type="checkbox" class="js-switch" name="negative_stock" checked/> 
                      @else
                        <input type="checkbox" class="js-switch" name="negative_stock"  /> 
                      @endif
                    @else
                      <input type="checkbox" class="js-switch" name="negative_stock" checked/> 
                    @endif
                  </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align" for="positive_stock">Debe haber suficiente stock para agregar el producto a la factura de cliente</label>
                <div class="col-md-2 col-sm-2 ">
                  <label>
                    @if ($config)
                      @if ($config->positive_stock == '1')
                        <input type="checkbox" class="js-switch" name="positive_stock" checked /> 
                      @else
                        <input type="checkbox" class="js-switch" name="positive_stock" /> 
                      @endif
                    @else
                      <input type="checkbox" class="js-switch" name="positive_stock" checked /> 
                    @endif
                  </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align" for="min_max_stock">Manejar minimos y maximos en stock</label>
                <div class="col-md-2 col-sm-2 ">
                  <label>
                    @if ($config)
                      @if ($config->min_max_stock == '1')
                        <input type="checkbox" class="js-switch" name="min_max_stock" checked /> 
                      @else
                        <input type="checkbox" class="js-switch" name="min_max_stock" /> 
                      @endif
                    @else
                      <input type="checkbox" class="js-switch" name="min_max_stock" checked /> 
                    @endif
                  </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align" for="min_notification">Enviar notificación si el producto llega al minimo</label>
                <div class="col-md-2 col-sm-2 ">
                  <label>
                    @if ($config)
                      @if ($config->min_notification == '1')
                        <input type="checkbox" class="js-switch" name="min_notification" checked /> 
                      @else
                        <input type="checkbox" class="js-switch" name="min_notification" /> 
                      @endif
                    @else
                      <input type="checkbox" class="js-switch" name="min_notification" checked /> 
                    @endif
                  </label>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <a href="/modules" class="btn btn-danger">Cancelar</a>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
              </div>

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
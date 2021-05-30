{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app') 

{{-- Place the content of the main page of the module --}}
@section('content')
  <div class="row">
    <div class="col-sm-12">
      <h1>{{  __('Modulos') }}</h1>

      <p>
          Lista de todos los modulos instalados en el sistema. Dentro de esta pantalla podrá activar o desactivar un modulo, asi como ingresar a la configuración propia de cada modulo.
      </p>

      <p>
        @foreach ($categories as $cat)
          <div class="page-title">
            <div class="title_left">
              <h3>{{ $cat }}</h3>
            </div>
          </div>

          @foreach ($modules as $module)
            @if ($cat == $module['category'])
              @if ($module['display'] == true)
                <div class="col-md-3   widget widget_tally_box">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>{{ $module['name'] }}</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li>
                          <label>
                            <input type="checkbox" class="js-switch" {{ ($module['status'] == 'enabled')?'checked': '' }} {{ ($module['required'] == true)? 'disabled="disabled"' : '' }} data-module="{{ $module['id'] }}" />
                          </label>
                        </li>
                        @if ($module['status'] == 'enabled')
                          @if ($module['hasSettings'])
                            <li>
                              <a href="/{{ $module['path'] }}/settings" role="button" aria-expanded="false"><i class="fa fa-cogs"></i></a>
                            </li>
                          @endif
                        @endif
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      {{ $module['description'] }}    
                    </div>
                  </div>
                </div>        
              @endif
            @endif
          @endforeach
          <div class="clearfix"></div>
        @endforeach
      </p>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript" async>
    $(document).ready( function() {
      $(":checkbox").click( function() {
        var module = $(this).attr('data-module');
        var status = $(this).is(":checked");
        var nstatus = 'activar';

        if(confirm('¿Estas seguro de ' + ((status == false)?'desactivar':'activar') + ' el módulo : '+module)){
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/actions/changeModuleStatus",
            dataType: 'json',
            type: 'post',
            data:{status: status, module: module},
            success: function(result) {
              if (result) {
                document.location.reload();
              } else {
                alert('Se encontró un error inesperado, vuelva a cargarlo o llame a su administrador para solucionar el problema.');
                document.location.reload();
              }
            }
          });
        } else {
          if (status) {
            $(this).prop('checked', false);
          } else {
            $(this).prop('checked', true);
          }
        }
      });
    });
  </script>
@endsection
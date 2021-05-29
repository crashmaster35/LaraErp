{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app') 

{{-- Place the content of the main page of the module --}}
@section('content')
  <div class="row">
    <div class="col-sm-12">
      <h1>{{  __('Module') }}</h1>

      <p>
          This is the list of the modules active/inactive
      </p>

      <p>
        @foreach ($modules as $module)
          {{ $module['name'] }} -> {{ $module['status'] }} ->  {{ ($module['required'] == true)? 'true' : 'false' }}  ->  {{ ($module['hasConfig'] == true)? 'true' : 'false' }} -> {{ $module['category'] }} <br/>
        @endforeach
      </p>
    </div>
  </div>
@endsection
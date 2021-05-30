{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app') 

{{-- Place the content of the main page of the module --}}
@section('content')
  <div class="row">
    <div class="col-sm-12">
    <h1>Settings</h1>

    <p>
        This view is loaded from module: {!! config('roles.name') !!} to the settings page
    </p>
    </div>
  </div>
@endsection
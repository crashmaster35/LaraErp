{{-- Allways extend the Layouts.app template --}}
@extends('layouts.app') 

{{-- Place the content of the main page of the module --}}
@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('user.name') !!}
    </p>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <h6>Bienvenido(a), {{Auth::user()->nombre}}</h6>
        </div>
    </div>  
</div>
<div class="fixed">
    <img src="/../img/undraw_appreciation_vmef.svg" alt="Imagen" width="200px">
</div>
@endsection

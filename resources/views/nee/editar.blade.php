@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar NEE</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/nee/actualizar/{{$nee->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$nee->id}}" />
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$nee->id}}" readonly />
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$nee->nombre}}" type="text"
                            class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                            required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$nee->descripcion}}" type="text"
                            class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"
                            required>
                        @error('descripcion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="link">Link<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$nee->link}}" type="text"
                            class="form-control @error('link') is-invalid @enderror" id="link" name="link"
                            require>
                        @error('link')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>    
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/nee" class="btn btn-primary tipoletra">Volver</a>
                    <button type="submit" class="btn btn-primary tipoletra">Editar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
$('#form').validate({
    rules: {
        nombre: {
            required: true,
            maxlength: 50
        },
        descripcion: {
            required: true,
            maxlength: 200
        },
        link: {
            required: true,
            maxlength: 500
        }
    }
});
</script>

@endsection
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar Institucion</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/institucion/actualizar/{{$institucion->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$institucion->id}}" />
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$institucion->nombre}}" type="text"
                            class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                            required >
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nombreRector">Nombre del rector<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$institucion->nombreRector}}" type="text"
                            class="form-control @error('nombreRector') is-invalid @enderror" name="nombreRector"
                            required >
                        @error('nombreRector')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nit">NIT<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$institucion->nit}}" type="number"
                            class="form-control @error('nit') is-invalid @enderror" name="nit"
                            required >
                        @error('nit')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="docDane">Doc Dane<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$institucion->docDane}}" type="number"
                            class="form-control @error('docDane') is-invalid @enderror" name="docDane"
                            required >
                        @error('docDane')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$institucion->telefono}}" type="number"
                            class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                            required >
                        @error('telefono')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="ciudad">En qué municipio se encuentra<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idCiudad">
                            <option value="">Seleccione</option>
                            @foreach($ciudad as $key => $value)
                            <option {{$value->id == $institucion->idCiudad ? 'selected' : ''}} value="{{$value->id}}">
                                {{$value->descripcion}}
                            </option>
                            @endforeach
                        </select>
                        @error('idCiudad')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="direccion">Dirección<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$institucion->direccion}}" type="text"
                            class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion"
                            required>
                        @error('direccion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>      
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/institucion" class="btn btn-primary tipoletra">Volver</a>
                    <button type="submit" class="btn btn-primary tipoletra">Editar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
$.validator.addMethod("numeros", function(value, element) {
    var pattern = /^[0-9]+$/;
    return this.optional(element) || pattern.test(value);
}, "Solo digite números positivos, por favor");

$.validator.addMethod("letras", function(value, element) {
    var pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s]+$/g;
    return this.optional(element) || pattern.test(value);
}, "No se admite caracteres especiales");

$('#form').validate({
    rules: {
        nombre: {
            letras: true,
            required: true,
            maxlength: 255
        },
        nit: {
            numeros: true,
            required: true,
            maxlength: 100
        },
        docDane: {
            letras: true,
            required: true,
            maxlength: 100
        },
        direccion: {
            required: true,
            maxlength: 255
        },
        telefono: {
            numeros: true,
            required: true,
            maxlength: 15
        },
        nombreRector: {
            letras: true,
            required: true,
            maxlength: 255
        },
        idCiudad: {
            required: true
        }
    }
});
</script>

@endsection
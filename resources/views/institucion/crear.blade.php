@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Institución</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/institucion/guardar" method="post">
            @csrf
            <div class="row">
                
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Nombre<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}"
                            class="form-control @error('nombre') is-invalid @enderror" name="nombre" required
                            autocomplete="nombre" placeholder="Ingrese su nombre" />
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nombreRector">Nombre del rector<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="nombreRector" type="text" name="nombreRector" value="{{ old('nombreRector') }}"
                            class="form-control @error('nombreRector') is-invalid @enderror" name="nombreRector" required
                            autocomplete="nombreRector" placeholder="Ingrese su nombreRector" />
                        @error('nombreRector')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nit">NIT<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="nit" type="text" name="nit" value="{{ old('nit') }}"
                            class="form-control @error('nit') is-invalid @enderror" name="nit" required
                            autocomplete="nit" placeholder="Ingrese su NIT" />
                        @error('nit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="docDane">Doc Dane<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="docDane" type="text" name="docDane" value="{{ old('docDane') }}"
                            class="form-control @error('docDane') is-invalid @enderror" name="docDane" required
                            autocomplete="docDane" placeholder="Ingrese su docDane" />
                        @error('docDane')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="telefono" type="text" name="telefono" value="{{ old('telefono') }}"
                            class="form-control @error('telefono') is-invalid @enderror" name="telefono" required
                            autocomplete="telefono" placeholder="Ingrese su telefono" />
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
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
                            <option value="{{$value->id}}" {{old('idCiudad') == $value->id ? 'selected' : ''}}>
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
                        <input id="direccion" type="text" name="direccion" value="{{ old('direccion') }}"
                            class="form-control @error('direccion') is-invalid @enderror" name="direccion" required
                            autocomplete="direccion" placeholder="Ingrese su direccion" />
                        @error('direccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/institucion" class="btn btn-primary tipoletra">Volver</a>
                    <button type="submit" class="btn btn-primary tipoletra">Crear</button>
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
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Usuario</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/usuario/guardar" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="idTipoDocumento">Tipo de Documento<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idTipoDocumento">
                            <option value="">Seleccione</option>
                            @foreach($tipoDocumento as $key => $value)
                            <option value="{{$value->id}}" {{old('idTipoDocumento') == $value->id ? 'selected' : ''}}>
                                {{$value->descripcion}}
                            </option>
                            @endforeach
                        </select>
                        @error('idTipoDocumento')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="numeroDocumento">Número de documento<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="numeroDocumento" type="number" name="numeroDocumento" value="{{ old('numeroDocumento') }}"
                            class="form-control @error('numeroDocumento') is-invalid @enderror" name="numeroDocumento" required
                            autocomplete="numeroDocumento" placeholder="Ingrese su número de documento" />
                        @error('numeroDocumento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="tipoUsuario">Tipo de Usuario<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idTipoUsuario">
                            <option value="">Seleccione</option>
                            @foreach($tipoUsuario as $key => $value)
                            <option value="{{$value->id}}" {{old('idTipoUsuario') == $value->id ? 'selected' : ''}}>
                                {{$value->descripcion}}
                            </option>
                            @endforeach
                        </select>
                        @error('idTipoUsuario')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellido">Apellido<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}"
                            class="form-control @error('apellido') is-invalid @enderror" name="apellido" required
                            autocomplete="apellido" placeholder="Ingrese su apellido" />
                        @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="email">Correo<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="email" type="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" name="email" required
                            autocomplete="email" placeholder="Ingrese su correo electrónico" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                

                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/usuario" class="btn btn-primary tipoletra">Volver</a>
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
$.validator.addMethod("email", function(value, element) {
    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    return this.optional(element) || pattern.test(value);
}, "Formato del email incorrecto");
$.validator.addMethod("letras", function(value, element) {
    var pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s]+$/g;
    return this.optional(element) || pattern.test(value);
}, "No se admite caracteres especiales");

$('#form').validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        nombre: {
            letras: true,
            required: true,
            maxlength: 100
        },
        apellido: {
            letras: true,
            required: true,
            maxlength: 100
        },
        numeroDocumento: {
            required: true,
            numeros: true,
            minlength: 7,
            maxlength: 10
        },
        idTipoDocumento: {
            required: true
        },
        idTipoUsuario: {
            required: true
        }
    }
});

function ucfirst(str, force) {
    str = force ? str.toLocaleLowerCase() : str;
    return str.replace(/(\b)([a-zA-Z])/,
        function(firstLetter) {
            return firstLetter.toLocaleLowerCase();
        });
}

$('#form').validate({
    rules: {
        nombre: {
            mouseout: true,
            required: true,
        },
        apellido: {
            mouseout: true,
            required: true,
        },
        email: {
            mouseout: true,
            required: true,
            email: true
        }
    },
});



$('input[type="email"]').keyup(function(evt) {
    // force: true to lower case all letter except first 
    var cp_value = ucfirst($(this).val(), true);
    // to capitalize all words 
    //var cp_value= ucwords($(this).val(),true) ; 
    $(this).val(cp_value);
});
</script>

@endsection
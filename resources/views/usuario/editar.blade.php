@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar Usuario</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/usuario/actualizar/{{$usuario->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$usuario->id}}" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="idTipoDocumento">Tipo de Documento<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idTipoDocumento">
                            <option value="">Seleccione</option>
                            @foreach($tipoDocumento as $key => $value)
                            <option {{$value->id == $usuario->idTipoDocumento ? 'selected' : ''}} value="{{$value->id}}">
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
                        <input value="{{$usuario->numeroDocumento}}" type="number"
                            class="form-control @error('numeroDocumento') is-invalid @enderror" name="numeroDocumento"
                            required minlength="7" maxlength="10">
                        @error('numeroDocumento')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
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
                            <option {{$value->id == $usuario->idTipoUsuario ? 'selected' : ''}} value="{{$value->id}}">
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
                        <input value="{{$usuario->nombre}}" type="text"
                            class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                            required>
                        @error('nombre')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellido">Apellido<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$usuario->apellido}}" type="text"
                            class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido"
                            require>
                        @error('apellido')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="email">Correo<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$usuario->email}}" type="text"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                              
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/usuario" class="btn btn-primary tipoletra">Volver</a>
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


function ucfirst(str, force) {
    str = force ? str.toLocaleLowerCase() : str;
    return str.replace(/(\b)([a-zA-Z])/,
        function(firstLetter) {
            return firstLetter.toLocaleLowerCase();
        });
}

$('input[type="email"]').keyup(function(evt) {
    // force: true to lower case all letter except first 
    var cp_value = ucfirst($(this).val(), true);
    // to capitalize all words 
    //var cp_value= ucwords($(this).val(),true) ; 
    $(this).val(cp_value);
});
</script>

@endsection
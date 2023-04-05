@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar profesional</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/profesional/actualizar/{{$profesional->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$profesional->id}}" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="idTipoDocumento">Tipo de Documento<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idTipoDocumento">
                            <option value="">Seleccione</option>
                            @foreach($tipoDocumento as $key => $value)
                            <option {{$value->id == $profesional->idTipoDocumento ? 'selected' : ''}} value="{{$value->id}}">
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
                        <label for="numeroDocumentoProfesional">Número de documento<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$profesional->numeroDocumentoProfesional}}" type="number"
                            class="form-control @error('numeroDocumentoProfesional') is-invalid @enderror" name="numeroDocumentoProfesional"
                            required minlength="7" maxlength="10">
                        @error('numeroDocumentoProfesional')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="nombreProfesional">Nombre<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$profesional->nombreProfesional}}" type="text"
                            class="form-control @error('nombreProfesional') is-invalid @enderror" id="nombreProfesional" name="nombreProfesional"
                            required>
                        @error('nombreProfesional')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellidoProfesional">Apellido<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$profesional->apellidoProfesional}}" type="text"
                            class="form-control @error('apellidoProfesional') is-invalid @enderror" id="apellidoProfesional" name="apellidoProfesional"
                            require>
                        @error('apellidoProfesional')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$profesional->telefono}}" type="number"
                            class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                            required minlength="7" maxlength="10">
                        @error('telefono')
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
                        <input value="{{$profesional->email}}" type="text"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                              
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/profesional" class="btn btn-primary tipoletra">Volver</a>
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
        nombreProfesional: {
            letras: true,
            required: true,
            maxlength: 100
        },
        apellidoProfesional: {
            letras: true,
            required: true,
            maxlength: 100
        },
        numeroDocumentoProfesional: {
            required: true,
            numeros: true,
            minlength: 7,
            maxlength: 10
        },
        idTipoDocumento: {
            required: true
        },
        telefono: {
            required: true,
            numeros: true,
            minlength: 7,
            maxlength: 10
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
        nombreProfesional: {
            mouseout: true,
            required: true,
        },
        apellidoProfesional: {
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
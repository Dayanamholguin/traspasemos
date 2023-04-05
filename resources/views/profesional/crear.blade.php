@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear profesional</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/profesional/guardar" method="post">
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
                        <label for="numeroDocumentoProfesional">Número de documento<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="numeroDocumentoProfesional" type="number" name="numeroDocumentoProfesional" value="{{ old('numeroDocumentoProfesional') }}"
                            class="form-control @error('numeroDocumentoProfesional') is-invalid @enderror" name="numeroDocumentoProfesional" required
                            autocomplete="numeroDocumentoProfesional" placeholder="Ingrese su número de documento" />
                        @error('numeroDocumentoProfesional')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="nombreProfesional">Nombre<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="nombreProfesional" type="text" name="nombreProfesional" value="{{ old('nombreProfesional') }}"
                            class="form-control @error('nombreProfesional') is-invalid @enderror" name="nombreProfesional" required
                            autocomplete="nombreProfesional" placeholder="Ingrese su nombreProfesional" />
                        @error('nombreProfesional')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="apellidoProfesional">Apellido<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="apellidoProfesional" type="text" name="apellidoProfesional" value="{{ old('apellidoProfesional') }}"
                            class="form-control @error('apellidoProfesional') is-invalid @enderror" name="apellidoProfesional" required
                            autocomplete="apellidoProfesional" placeholder="Ingrese su apellidoProfesional" />
                        @error('apellidoProfesional')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="telefono" type="number" name="telefono" value="{{ old('telefono') }}"
                            class="form-control @error('telefono') is-invalid @enderror" name="telefono" required
                            autocomplete="telefono" placeholder="Ingrese su número de teléfono" />
                        @error('telefono')
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
                    <a href="/profesional" class="btn btn-primary tipoletra">Volver</a>
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
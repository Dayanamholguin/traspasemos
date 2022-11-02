@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear ficha</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/ficha/guardar" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$ficha==null?"1":($ficha->id+1)}}" readonly />
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="numeroFicha">Número de la ficha<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="numeroFicha" type="number" name="numeroFicha" value="{{ old('numeroFicha') }}"
                            class="form-control @error('numeroFicha') is-invalid @enderror" name="numeroFicha" required
                            autocomplete="numeroFicha" placeholder="Ingrese número de la ficha" />
                        @error('numeroFicha')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="idEstadoFicha">Estado de la ficha<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idEstadoFicha">
                            <option value="">Seleccione</option>
                            @foreach($estadoFicha as $key => $value)
                            <option value="{{$value->id}}" {{old('idEstadoFicha') == $value->id ? 'selected' : ''}}>
                                {{$value->descripcion}}
                            </option>
                            @endforeach
                        </select>
                        @error('idEstadoFicha')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="idInstructor">Instructor<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idInstructor">
                            <option value="">Seleccione</option>
                            @foreach($instructor as $key => $value)
                            <option value="{{$value->id}}" {{old('idInstructor') == $value->id ? 'selected' : ''}}>
                                {{$value->fullName}}
                            </option>
                            @endforeach
                        </select>
                        @error('idInstructor')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="idInstitucion">Institución<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idInstitucion">
                            <option value="">Seleccione</option>
                            @foreach($institucion as $key => $value)
                            <option value="{{$value->id}}" {{old('idInstitucion') == $value->id ? 'selected' : ''}}>
                                {{$value->nombre}}
                            </option>
                            @endforeach
                        </select>
                        @error('idInstitucion')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="idPrograma">Programa<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idPrograma">
                            <option value="">Seleccione</option>
                            @foreach($programa as $key => $value)
                            <option value="{{$value->id}}" {{old('idPrograma') == $value->id ? 'selected' : ''}}>
                                {{$value->descripcion}}
                            </option>
                            @endforeach
                        </select>
                        @error('idPrograma')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/datosAcademico" class="btn btn-primary tipoletra">Volver</a>
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
    $('#form').validate({
        rules: {
            numeroFicha: {
                required: true,
                numeros: true,
                minlength: 7,
                maxlength: 20
            },
            idInstructor: {
                required: true,
            },
            idInstitucion: {
                required: true,
            },
            idPrograma: {
                required: true,
            },
            idEstadoFicha: {
                required: true,
            }
        }
    });
</script>
@endsection
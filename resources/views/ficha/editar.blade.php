@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar ficha</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/ficha/actualizar/{{$ficha->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$ficha->id}}" />
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$ficha->id}}" readonly />
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="numeroFicha">Número de la ficha<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$ficha->numeroFicha}}" type="number"
                            class="form-control @error('numeroFicha') is-invalid @enderror" name="numeroFicha"
                            required minlength="7" maxlength="10">
                        @error('numeroFicha')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
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
                            <option {{$value->id == $ficha->idEstadoFicha ? 'selected' : ''}} value="{{$value->id}}">
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
                            <option {{$value->id == $ficha->idInstructor ? 'selected' : ''}} value="{{$value->id}}">
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
                            <option {{$value->id == $ficha->idInstitucion ? 'selected' : ''}} value="{{$value->id}}">
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
                            <option {{$value->id == $ficha->idPrograma ? 'selected' : ''}} value="{{$value->id}}">
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
                    <a href="/ficha" class="btn btn-primary tipoletra">Volver</a>
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
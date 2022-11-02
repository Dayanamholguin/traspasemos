@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar datos académicos</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/datosAcademico/actualizar/{{$datosAcademico->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$datosAcademico->id}}" />
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$datosAcademico->id}}" readonly />
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="idEstadoAprendiz">Estado del aprendiz<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idEstadoAprendiz">
                            <option value="">Seleccione</option>
                            @foreach($estadoAprendiz as $key => $value)
                            <option {{$value->id == $datosAcademico->idEstadoAprendiz ? 'selected' : ''}} value="{{$value->id}}">
                                {{$value->descripcion}}
                            </option>
                            @endforeach
                        </select>
                        @error('idEstadoAprendiz')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="idUsuario">Usuario<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idUsuario">
                            <option value="">Seleccione</option>
                            @foreach($usuario as $key => $value)
                            <option {{$value->id == $datosAcademico->idUsuario ? 'selected' : ''}} value="{{$value->id}}">
                                {{$value->fullName}}
                            </option>
                            @endforeach
                        </select>
                        @error('idUsuario')
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
                            <option {{$value->id == $datosAcademico->idInstitucion ? 'selected' : ''}} value="{{$value->id}}">
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
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="idPrograma">Programa<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idPrograma">
                            <option value="">Seleccione</option>
                            @foreach($programa as $key => $value)
                            <option {{$value->id == $datosAcademico->idPrograma ? 'selected' : ''}} value="{{$value->id}}">
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
        idUsuario: {
            required: true,
        },
        idInstitucion: {
            required: true,
        },
        idPrograma: {
            required: true,
        },
        idEstadoAprendiz: {
            required: true,
        }
    }
});
</script>

@endsection
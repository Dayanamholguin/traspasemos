@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear datos académicos</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/datosAcademico/guardar" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$datosAcademico==null?"1":($datosAcademico->id+1)}}" readonly />
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="idEstadoAprendiz">Estado del aprendiz<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <select class="form-control" name="idEstadoAprendiz">
                            <option value="">Seleccione</option>
                            @foreach($estadoAprendiz as $key => $value)
                            <option value="{{$value->id}}" {{old('idEstadoAprendiz') == $value->id ? 'selected' : ''}}>
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
                            <option value="{{$value->id}}" {{old('idUsuario') == $value->id ? 'selected' : ''}}>
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
                <div class="col-md-6 col-sm-12">
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
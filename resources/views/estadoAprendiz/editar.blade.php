@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Editar Estado de Aprendiz</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/estadoAprendiz/actualizar/{{$estadoAprendiz->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$estadoAprendiz->id}}" />
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$estadoAprendiz->id}}" readonly />
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input value="{{$estadoAprendiz->descripcion}}" type="text"
                            class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"
                            required>
                        @error('descripcion')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>  
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/estadoAprendiz" class="btn btn-primary tipoletra">Volver</a>
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
        descripcion: {
            required: true,
            maxlength: 500
        },
    }
});
</script>

@endsection
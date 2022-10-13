@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Estado de Aprendiz</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/estadoAprendiz/guardar" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$estadoAprendiz==null?"1":($estadoAprendiz->id+1)}}" readonly />
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="descripcion" type="text" name="descripcion" value="{{ old('descripcion') }}"
                            class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required
                            autocomplete="descripcion" placeholder="Ingrese su descripción" />
                        @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/estadoAprendiz" class="btn btn-primary tipoletra">Volver</a>
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
        descripcion: {
            required: true,
            maxlength: 500
        },
    }
});
</script>

@endsection
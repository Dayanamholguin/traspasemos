@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Programa</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form" action="/programa/guardar" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Id<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" class="form-control" value="{{$programa==null?"1":($programa->id+1)}}" readonly />
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <label for="version">Descripción<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="version" type="text" name="descripcion" value="{{ old('descripcion') }}"
                            class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required
                            autocomplete="descripcion" placeholder="Ingrese nombre del programa" />
                        @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="version">Versión<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="version" type="text" name="version" value="{{ old('version') }}"
                            class="form-control @error('version') is-invalid @enderror" name="version" required
                            autocomplete="version" placeholder="Ingrese versión del programa" />
                        @error('version')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <label for="link">Link<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input id="link" type="text" name="link" value="{{ old('link') }}"
                            class="form-control @error('link') is-invalid @enderror" name="link" required
                            autocomplete="link" placeholder="Ingrese el link" />
                        @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="/programa" class="btn btn-primary tipoletra">Volver</a>
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
        version: {
            required: true,
            maxlength: 500
        },
        link: {
            required: true,
            maxlength: 500
        }
    }
});
</script>

@endsection
@extends('layouts.app')

@section('content')
<div>
    {{-- <input id="dato" type="text"> --}}
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <select class="form-control" id="institucionFiltrar">
                    <option value="">Seleccione Institución</option>
                    @foreach($institucion as $key => $value)
                    <option value="{{$value->id}}">
                        {{$value->nombre}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <select class="form-control" id="programaFiltrar">
                    <option value="">Seleccione programa</option>
                    @foreach($programa as $key => $value)
                    <option value="{{$value->id}}">
                        {{$value->descripcion}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <button id="filtrar" class="btn btn-primary tipoletra" style="width: 100%;"><i class="fas fa-search"></i> Filtrar por institución o programa</button>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <a href="/datosAcademico/crear" class="alert-link btn btn-primary tipoletra"><i class="bi bi-person-plus"></i> Crear datos académicos</a>
            </div>
        </div>        
    </div>
    <div class="card-body">
    @include('flash::message')
        <table id="datosAcademico" class="table table-bordered dt-responsive dataTable text-left" style="width: 100%;">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Institución</th>
                    <th>Programa</th>
                    <th>Estado del aprendiz</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="verdatos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <strong>Información del programa</strong>
                        <hr>
                    </div>
                    
                    <div class="col-md-12 container">
                        <p class="float-start"><strong>Descripción:</strong> <a class="float-right text-dark" style="word-break: break-all; text-decoration: none;" id="descripcionModal"></a></p>
                        <p class="float-start"><strong>Versión:</strong> <a class="float-right text-dark" style="word-break: break-all; text-decoration: none;" id="versionModal"></a></p>
                        <p class="float-start"><strong>Link:</strong> <a class="float-right text-dark" style="word-break: break-all; text-decoration: none;" id="linkModal"></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    $(document).ready(function() {
        
        var institucion;
        var programa;
        var filtrar = false;
        var url = '/datosAcademico/listar';

        $(document).on('change', '#institucionFiltrar', function(event) {
            institucion = $("#institucionFiltrar").val();
        });

        $(document).on('change', '#programaFiltrar', function(event) {
            programa = $("#programaFiltrar").val();
        });
        
        $('#filtrar').click(function(){
            // alert(institucion + " - " + programa);
            if (institucion != null || programa != null) {
                programa = programa != null ? programa:"";
                institucion = institucion != null ? institucion:"";
                // programa == ""?1:programa;
                // alert(institucion + " - " + programa);
                filtrar = true;
                // alert(filtrar);
                filtro = institucion + ","+programa;
                console.log(filtro);
                
                url = `/datosAcademico/filtrar/${filtro}`;
                listar(url);
            }
            
        });
        function listar(url) {
            $('#datosAcademico').DataTable().destroy();
                $('#datosAcademico').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: url,
                    columns: [{
                            data: 'usuario',
                            name: 'usuario',
                        },
                        {
                            data: 'institucion',
                            name: 'institucion'
                        },
                        {
                            data: 'programa',
                            name: 'programa'
                        },
                        {
                            data: 'estadoAprendiz',
                            name: 'estadoAprendiz'
                        },
                        {
                            data: 'estado',
                            name: 'estado'
                        },
                        {
                            data: 'acciones',
                            name: 'acciones'
                        },
                        
                    ],
                    language: {   
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "search": "Buscar:",
                        "infoThousands": ",",
                        "loadingRecords": "Cargando...",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "aria": {
                            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad",
                            "collection": "Colección",
                            "colvisRestore": "Restaurar visibilidad",
                            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                            "copySuccess": {
                                "1": "Copiada 1 fila al portapapeles",
                                "_": "Copiadas %d fila al portapapeles"
                            },
                            "copyTitle": "Copiar al portapapeles",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Mostrar todas las filas",
                                "_": "Mostrar %d filas"
                            },
                            "pdf": "PDF",
                            "print": "Imprimir"
                        },
                        "autoFill": {
                            "cancel": "Cancelar",
                            "fill": "Rellene todas las celdas con <i>%d<\/i>",
                            "fillHorizontal": "Rellenar celdas horizontalmente",
                            "fillVertical": "Rellenar celdas verticalmentemente"
                        },
                        "decimal": ",",
                        "searchBuilder": {
                            "add": "Añadir condición",
                            "button": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "clearAll": "Borrar todo",
                            "condition": "Condición",
                            "conditions": {
                                "date": {
                                    "after": "Despues",
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vacío",
                                    "equals": "Igual a",
                                    "notBetween": "No entre",
                                    "notEmpty": "No Vacio",
                                    "not": "Diferente de"
                                },
                                "number": {
                                    "between": "Entre",
                                    "empty": "Vacio",
                                    "equals": "Igual a",
                                    "gt": "Mayor a",
                                    "gte": "Mayor o igual a",
                                    "lt": "Menor que",
                                    "lte": "Menor o igual que",
                                    "notBetween": "No entre",
                                    "notEmpty": "No vacío",
                                    "not": "Diferente de"
                                },
                                "string": {
                                    "contains": "Contiene",
                                    "empty": "Vacío",
                                    "endsWith": "Termina en",
                                    "equals": "Igual a",
                                    "notEmpty": "No Vacio",
                                    "startsWith": "Empieza con",
                                    "not": "Diferente de"
                                },
                                "array": {
                                    "not": "Diferente de",
                                    "equals": "Igual",
                                    "empty": "Vacío",
                                    "contains": "Contiene",
                                    "notEmpty": "No Vacío",
                                    "without": "Sin"
                                }
                            },
                            "data": "Data",
                            "deleteTitle": "Eliminar regla de filtrado",
                            "leftTitle": "Criterios anulados",
                            "logicAnd": "Y",
                            "logicOr": "O",
                            "rightTitle": "Criterios de sangría",
                            "title": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "value": "Valor"
                        },
                        "searchPanes": {
                            "clearMessage": "Borrar todo",
                            "collapse": {
                                "0": "Paneles de búsqueda",
                                "_": "Paneles de búsqueda (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "Sin paneles de búsqueda",
                            "loadMessage": "Cargando paneles de búsqueda",
                            "title": "Filtros Activos - %d"
                        },
                        "select": {
                            "cells": {
                                "1": "1 celda seleccionada",
                                "_": "%d celdas seleccionadas"
                            },
                            "columns": {
                                "1": "1 columna seleccionada",
                                "_": "%d columnas seleccionadas"
                            },
                            "rows": {
                                "1": "1 fila seleccionada",
                                "_": "%d filas seleccionadas"
                            }
                        },
                        "thousands": ".",
                        "datetime": {
                            "previous": "Anterior",
                            "next": "Proximo",
                            "hours": "Horas",
                            "minutes": "Minutos",
                            "seconds": "Segundos",
                            "unknown": "-",
                            "amPm": [
                                "AM",
                                "PM"
                            ],
                            "months": {
                                "0": "Enero",
                                "1": "Febrero",
                                "10": "Noviembre",
                                "11": "Diciembre",
                                "2": "Marzo",
                                "3": "Abril",
                                "4": "Mayo",
                                "5": "Junio",
                                "6": "Julio",
                                "7": "Agosto",
                                "8": "Septiembre",
                                "9": "Octubre"
                            },
                            "weekdays": [
                                "Dom",
                                "Lun",
                                "Mar",
                                "Mie",
                                "Jue",
                                "Vie",
                                "Sab"
                            ]
                        },
                        "editor": {
                            "close": "Cerrar",
                            "create": {
                                "button": "Nuevo",
                                "title": "Crear Nuevo Registro",
                                "submit": "Crear"
                            },
                            "edit": {
                                "button": "Editar",
                                "title": "Editar Registro",
                                "submit": "Actualizar"
                            },
                            "remove": {
                                "button": "Eliminar",
                                "title": "Eliminar Registro",
                                "submit": "Eliminar",
                                "confirm": {
                                    "_": "¿Está seguro que desea eliminar %d filas?",
                                    "1": "¿Está seguro que desea eliminar 1 fila?"
                                }
                            },
                            "error": {
                                "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                            },
                            "multi": {
                                "title": "Múltiples Valores",
                                "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                                "restore": "Deshacer Cambios",
                                "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                            }
                        },
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
                    }
                });
        }
        listar(url);
        // new $.fn.dataTable.FixedHeader( usuario );
    });
    function mostrardatos(id) {
        console.log(id);
        $('#verdatos').modal('toggle');
        $.ajax({
            url: `/datosAcademico/ver/${id}`,
            type: "GET",
            success: function(res) {
                $('#descripcionModal').html(res.programa.descripcion);
                $('#versionModal').html(res.programa.version);
                $('#versionModal').html(res.programa.version);
                $('#linkModal').html(res.programa.link);
            },
        });
    }
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
       
        <a href="/profesional/crear" class="alert-link btn btn-primary tipoletra"><i class="bi bi-person-plus"></i> Crear profesional</a>
        
    </div>
    <div class="card-body">
    @include('flash::message')
        <table id="profesional" class="table table-bordered dt-responsive dataTable text-left" style="width: 100%;">
            <thead>
                <tr>
                    <th>Tipo documento</th>
                    <th>N° Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
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
<div class="modal fade" id="verProfesional" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <strong>Ver Información del profesional</strong>
                        <hr>
                    </div>
                    
                    <div class="col-md-12 container">
                        <p class="float-start"><strong>Nombre:</strong> <a class="float-right text-dark" style="text-decoration: none;" id="nombre"></a></p>
                            <p class="float-start"><strong>Apellido:</strong> <a class="float-right text-dark" style="text-decoration: none;" id="apellido"></a></p>
                            <p class="float-start"><strong>Email:</strong> <a class="float-right text-dark" style="word-break: break-all; text-decoration: none;" id="email"></a></p>
                            <p class="float-start"><strong>Teléfono:</strong> <a class="float-right text-dark" style="text-decoration: none;" id="telefono"></a></p>
                            <p class="float-start"><strong>Tipo de documento:</strong> <a class="float-right text-dark" style="text-decoration: none;" id="tipoDocumento"></a></p>
                            <p class="float-start"><strong>Número de documento</strong> <a class="float-right text-dark" style="text-decoration: none;" id="numeroDocumento"></a></p>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <hr>
                        <a style="text-decoration: none;" id="creacion" class="text-muted"></a>
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
        $('#profesional').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/profesional/listar',
            columns: [{
                    data: 'tipoDocumento',
                    name: 'tipoDocumento',
                },
                {
                    data: 'numeroDocumentoProfesional',
                    name: 'numeroDocumentoProfesional'
                },
                {
                    data: 'nombreProfesional',
                    name: 'nombreProfesional'
                },
                {
                    data: 'apellidoProfesional',
                    name: 'apellidoProfesional'
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
        // new $.fn.dataTable.FixedHeader( profesional );
    });
    function mostrarVentana(id) {
        var options = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hours: 'numeric'};
        $('#verProfesional').modal('toggle');
        // moment.locale('es');
        $.ajax({
            url: `/profesional/ver/${id}`,
            type: "GET",
            success: function(res) {
                $('#nombre').html(res.profesional.nombreProfesional);
                $('#apellido').html(res.profesional.apellidoProfesional);
                $('#email').html(res.profesional.email);
                $('#tipoDocumento').html(res.tipoDocumento);
                $('#numeroDocumento').html(res.profesional.numeroDocumentoProfesional);
                $('#telefono').html(res.profesional.telefono);
                $('#creacion').html("Creado en "+moment(res.profesional.created_at).format('MM DD YYYY'));       
            },
        });
    }
</script>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Flash;
use App\Models\DatosAcademicos;
use App\Models\institucion;
use App\Models\Programa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class datosAcademicosController extends Controller
{
    public function index()
    {
        return view('datosAcademico.index');
    }

    public function listar(Request $request)
    {
        $datosAcademico = DatosAcademicos::select("datosAcademicos.*", DB::Raw("CONCAT(users.nombre, ' ', users.apellido) AS usuario"), "institucion.nombre as institucion", "programa.descripcion as programa", "estadoAprendiz.descripcion as estadoAprendiz")
            ->join("users", "datosAcademicos.idUsuario", "users.id")
            ->join("institucion", "datosAcademicos.idInstitucion", "institucion.id")
            ->join("programa", "datosAcademicos.idPrograma", "programa.id")
            ->join("estadoAprendiz", "datosAcademicos.idEstadoAprendiz", "estadoAprendiz.id")
            ->get();
            return DataTables::of($datosAcademico)
            ->editColumn("estado", function ($datosAcademico) {
                return $datosAcademico->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($datosAcademico) {
                $acciones = '<a href="/datosAcademico/editar/' . $datosAcademico->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                // $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrardatos(' . $datosAcademico->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarVentana(' . $datosAcademico->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // // if ($datosAcademico->id!=2) {
                    if ($datosAcademico->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/datosAcademico/cambiar/estado/' . $datosAcademico->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/datosAcademico/cambiar/estado/' . $datosAcademico->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $datosAcademico = DatosAcademicos::select('*')->orderBy('id', 'desc')->first();
        $usuario = User::select('users.*',DB::Raw("CONCAT(nombre, ' ', apellido) AS fullName"))->where('users.idTipoUsuario', 3)->where('users.estado',1)->get();
        $institucion = institucion::select('*')->where('estado',1)->get();
        $programa = Programa::select('*')->where('estado',1)->get();
        $estadoAprendiz = DB::table('estadoAprendiz')->where('estado',1)->get();
        return view('datosAcademico.crear', compact("datosAcademico","usuario", "institucion", "programa", "estadoAprendiz"));
    }
    public function guardar(Request $request)
    {
        $request->validate(DatosAcademicos::$rules);
        $input = $request->all();
        try {
            DatosAcademicos::create([
                'idUsuario' => $input['idUsuario'],
                'idInstitucion' => $input['idInstitucion'],
                'idPrograma' => $input['idPrograma'],
                'idEstadoAprendiz' => $input['idEstadoAprendiz'],
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/datosAcademico");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/datosAcademico/crear");
        }
    }
    public function editar($id)
    {
        $datosAcademico = DatosAcademicos::find($id);
        if ($datosAcademico==null) {
            Flash('Ese dato académico no está registrado en el sistema')->error();
            return redirect("/datosAcademico");
        }
        $usuario = User::select('users.*',DB::Raw("CONCAT(nombre, ' ', apellido) AS fullName"))->where('users.idTipoUsuario', 3)->where('users.estado',1)->get();
        $institucion = institucion::select('*')->where('estado',1)->get();
        $programa = Programa::select('*')->where('estado',1)->get();
        $estadoAprendiz = DB::table('estadoAprendiz')->where('estado',1)->get();
        return view('datosAcademico.editar', compact("datosAcademico","usuario", "institucion", "programa", "estadoAprendiz"));
    }

    public function modificar(Request $request) 
    {
        $datosAcademico=DatosAcademicos::find($request->id);
        if ($datosAcademico==null) {
            Flash('Ese dato académico no está registrado en el sistema')->error();
            return back();
        }

        $request->validate(DatosAcademicos::$rules);
        $input = $request->all();
        
        try {
            $datosAcademico->update([
                'idUsuario' => $input['idUsuario'],
                'idInstitucion' => $input['idInstitucion'],
                'idPrograma' => $input['idPrograma'],
                'idEstadoAprendiz' => $input['idEstadoAprendiz'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/datosAcademico");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/datosAcademico/editar/{$request->id}");
        }
    }
    
    public function modificarEstado($id, $estado)
    {
        $datosAcademico = DatosAcademicos::find($id);
        if ($datosAcademico == null) {
            Flash('Ese dato académico no está registrado en el sistema')->error();
            return back();
        }
        try {
            $datosAcademico->update([
                "estado" => $estado,
            ]);
            Flash('Se ha modificado el estado del dato académico correctamente')->success();
            return redirect("/datosAcademico");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/datosAcademico");
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EstadoFicha;
use Illuminate\Http\Request;
use DataTables;
use Flash;
use App\Models\ficha;
use App\Models\institucion;
use App\Models\Programa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class fichaController extends Controller
{
    public function index()
    {
        return view('ficha.index');
    }

    public function listar(Request $request)
    {
        $ficha = ficha::select("ficha.*", "institucion.nombre as institucion", "programa.descripcion as programa")
            ->join("institucion", "ficha.idInstitucion", "institucion.id")
            ->join("programa", "ficha.idPrograma", "programa.id")
            ->get();
            return DataTables::of($ficha)
            ->editColumn("estado", function ($ficha) {
                return $ficha->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($ficha) {
                $acciones = '<a href="/ficha/editar/' . $ficha->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarFicha(' . $ficha->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // // if ($ficha->id!=2) {
                    if ($ficha->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/ficha/cambiar/estado/' . $ficha->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/ficha/cambiar/estado/' . $ficha->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $ficha = ficha::select('*')->orderBy('id', 'desc')->first();
        $instructor = User::select('users.*',DB::Raw("CONCAT(nombre, ' ', apellido) AS fullName"))->where('users.idTipoUsuario', 2)->where('users.estado',1)->get();
        $institucion = institucion::select('*')->where('estado',1)->get();
        $programa = Programa::select('*')->where('estado',1)->get();
        $estadoFicha = DB::table('estadoFicha')->where('estado',1)->get();
        return view('ficha.crear', compact("ficha","instructor", "institucion", "programa", "estadoFicha"));
    }
    public function guardar(Request $request)
    {
        $request->validate(ficha::$rules);
        $input = $request->all();
        try {
            ficha::create([
                'numeroFicha' => $input['numeroFicha'],
                'idPrograma' => $input['idPrograma'],
                'idInstitucion' => $input['idInstitucion'],
                'idInstructor' => $input['idInstructor'],
                'idEstadoFicha' => $input['idEstadoFicha'],
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/ficha");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/ficha/crear");
        }
    }
    public function editar($id)
    {
        $ficha = ficha::find($id);
        if ($ficha==null) {
            Flash('Esa ficha no está registrada en el sistema')->error();
            return redirect("/ficha");
        }
        $instructor = User::select('users.*',DB::Raw("CONCAT(nombre, ' ', apellido) AS fullName"))->where('users.idTipoUsuario', 2)->where('users.estado',1)->get();
        $institucion = institucion::select('*')->where('estado',1)->get();
        $programa = Programa::select('*')->where('estado',1)->get();
        $estadoFicha = DB::table('estadoFicha')->where('estado',1)->get();
        return view('ficha.editar', compact("ficha","instructor", "institucion", "programa", "estadoFicha"));
    }

    public function ver($id)
    {
        $ficha = ficha::find($id);
        $programa = Programa::select('descripcion')->join("ficha", "ficha.idPrograma", "programa.id")->where("ficha.id", $ficha->id)->value('descripcion');
        $institucion = institucion::select('nombre')->join("ficha", "ficha.idInstitucion", "institucion.id")->where("ficha.id", $ficha->id)->value('nombre');
        $instructor = User::select(DB::Raw("CONCAT(nombre, ' ', apellido) AS fullName"))->join("ficha", "ficha.idInstructor", "users.id")->where("ficha.id", $ficha->id)->value('fullName');
        $estadoFicha = EstadoFicha::select('descripcion')->join("ficha", "ficha.idEstadoFicha", "estadoFicha.id")->where("ficha.id", $ficha->id)->value('descripcion');
        return compact("ficha", "programa", "institucion", "instructor", "estadoFicha");
    }
    
    public function modificar(Request $request) 
    {
        $ficha=ficha::find($request->id);
        if ($ficha==null) {
            Flash('Esa ficha no está registrada en el sistema')->error();
            return back();
        }

        $request->validate(ficha::$rules);
        $input = $request->all();
        
        try {
            $ficha->update([
                'numeroFicha' => $input['numeroFicha'],
                'idPrograma' => $input['idPrograma'],
                'idInstitucion' => $input['idInstitucion'],
                'idInstructor' => $input['idInstructor'],
                'idEstadoFicha' => $input['idEstadoFicha'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/ficha");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/ficha/editar/{$request->id}");
        }
    }
    
    public function modificarEstado($id, $estado)
    {
        $ficha = ficha::find($id);
        if ($ficha == null) {
            Flash('Esa ficha no está registrada en el sistema')->error();
            return back();
        }
        try {
            $ficha->update([
                "estado" => $estado,
            ]);
            Flash('Se ha modificado el estado de la ficha correctamente')->success();
            return redirect("/ficha");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/ficha");
        }
    }
}

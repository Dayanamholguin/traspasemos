<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\EstadoAprendiz;

class estadoAprendizController extends Controller
{
    public function index()
    {
        return view('estadoAprendiz.index');
    }

    public function listar(Request $request)
    {
        $estadoAprendiz = estadoAprendiz::all();
            return DataTables::of($estadoAprendiz)
            ->editColumn("estado", function ($estadoAprendiz) {
                return $estadoAprendiz->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($estadoAprendiz) {
                $acciones = '<a href="/estadoAprendiz/editar/' . $estadoAprendiz->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                // if ($estadoAprendiz->id!=2) {
                    if ($estadoAprendiz->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/estadoAprendiz/cambiar/estado/' . $estadoAprendiz->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/estadoAprendiz/cambiar/estado/' . $estadoAprendiz->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $estadoAprendiz = estadoAprendiz::select('*')->orderBy('id', 'desc')->first();
        return view('estadoAprendiz.crear', compact("estadoAprendiz"));
    }
    public function guardar(Request $request)
    {
        $request->validate(estadoAprendiz::$rules);
        $input = $request->all();
        $estadoAprendizDescripcion = estadoAprendiz::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($estadoAprendizDescripcion!=null) {
            Flash("Este estado de aprendiz «".$estadoAprendizDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/estadoAprendiz/crear");
        }
        try {
            estadoAprendiz::create([
                'descripcion' => $input['descripcion'],
                'estado' => 1,
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/estadoAprendiz");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/estadoAprendiz/crear");
        }
    }
    public function editar($id)
    {
        $estadoAprendiz = estadoAprendiz::find($id);
        if ($estadoAprendiz==null) {
            Flash('Ese estado de aprendiz no está registrada en el sistema')->error();
            return redirect("/estadoAprendiz");
        }
        return view("estadoAprendiz.editar", compact("estadoAprendiz"));
    }
    public function modificar(Request $request) 
    {
        $estadoAprendiz=estadoAprendiz::find($request->id);
        if ($estadoAprendiz==null) {
            Flash('Ese estado de aprendiz no está registrada en el sistema')->error();
            return back();
        }
        $estadoAprendizDescripcion = estadoAprendiz::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($estadoAprendizDescripcion!=null) {
            Flash("Este estado de aprendiz «".$estadoAprendizDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/estadoAprendiz/editar/$request->id");
        }
        $request->validate(estadoAprendiz::$rules);
        $input = $request->all();
        try {
            $estadoAprendiz->update([
                'descripcion' => $input['descripcion'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/estadoAprendiz");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/estadoAprendiz/editar/{$request->id}");
        }
    }
    public function modificarEstado($id, $estado)
    {
        $estadoAprendiz = estadoAprendiz::find($id);
        if ($estadoAprendiz == null) {
            Flash("No se puede modificar el estado")->error();
            return redirect("/estadoAprendiz");
        }
        try {
            $estadoAprendiz->update([
                "estado" => $estado,
            ]);
            Flash("Se modificó el estado correctamente")->success();
            return redirect("/estadoAprendiz");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/estadoAprendiz");
        }
    }
}

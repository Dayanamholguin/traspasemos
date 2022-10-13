<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use DataTables;
use App\Models\EstadoFicha;

class estadoFichaController extends Controller
{
    public function index()
    {
        return view('estadoFicha.index');
    }

    public function listar(Request $request)
    {
        $estadoFicha = estadoFicha::all();
            return DataTables::of($estadoFicha)
            ->editColumn("estado", function ($estadoFicha) {
                return $estadoFicha->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($estadoFicha) {
                $acciones = '<a href="/estadoFicha/editar/' . $estadoFicha->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                // if ($estadoFicha->id!=2) {
                    if ($estadoFicha->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/estadoFicha/cambiar/estado/' . $estadoFicha->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/estadoFicha/cambiar/estado/' . $estadoFicha->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $estadoFicha = estadoFicha::select('*')->orderBy('id', 'desc')->first();
        return view('estadoFicha.crear', compact("estadoFicha"));
    }
    public function guardar(Request $request)
    {
        $request->validate(estadoFicha::$rules);
        $input = $request->all();
        $estadoFicha = estadoFicha::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($estadoFicha!=null) {
            Flash("Este estado de ficha «".$estadoFicha."» ya está en uso, intente nuevamente")->error();
            return redirect("/estadoFicha/crear");
        }
        try {
            estadoFicha::create([
                'descripcion' => $input['descripcion'],
                'estado' => 1,
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/estadoFicha");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/estadoFicha/crear");
        }
    }
    public function editar($id)
    {
        $estadoFicha = estadoFicha::find($id);
        if ($estadoFicha==null) {
            Flash('Ese estado de ficha no está registrada en el sistema')->error();
            return redirect("/estadoFicha");
        }
        return view("estadoFicha.editar", compact("estadoFicha"));
    }
    public function modificar(Request $request) 
    {
        $estadoFicha=estadoFicha::find($request->id);
        if ($estadoFicha==null) {
            Flash('Ese estado de ficha no está registrada en el sistema')->error();
            return back();
        }
        $estadoFichaDescripcion = estadoFicha::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($estadoFichaDescripcion!=null) {
            Flash("Este estado de ficha «".$estadoFichaDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/estadoFicha/editar/$request->id");
        }
        $request->validate(estadoFicha::$rules);
        $input = $request->all();
        try {
            $estadoFicha->update([
                'descripcion' => $input['descripcion'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/estadoFicha");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/estadoFicha/editar/{$request->id}");
        }
    }
    public function modificarEstado($id, $estado)
    {
        $estadoFicha = estadoFicha::find($id);
        if ($estadoFicha == null) {
            Flash("No se puede modificar el estado")->error();
            return redirect("/estadoFicha");
        }
        try {
            $estadoFicha->update([
                "estado" => $estado,
            ]);
            Flash("Se modificó el estado correctamente")->success();
            return redirect("/estadoFicha");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/estadoFicha");
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use DataTables;
use App\Models\Discapacidad;
use Illuminate\Support\Facades\Hash;

class discapacidadController extends Controller
{
    public function index()
    {
        return view('discapacidad.index');
    }

    public function listar(Request $request)
    {
        $discapacidad = Discapacidad::all();
            return DataTables::of($discapacidad)
            ->editColumn("estado", function ($discapacidad) {
                return $discapacidad->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($discapacidad) {
                $acciones = '<a href="/discapacidad/editar/' . $discapacidad->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarDiscapacidad(' . $discapacidad->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // if ($discapacidad->id!=2) {
                    if ($discapacidad->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/discapacidad/cambiar/estado/' . $discapacidad->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/discapacidad/cambiar/estado/' . $discapacidad->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $discapacidad = Discapacidad::select('*')->orderBy('id', 'desc')->first();
        return view('discapacidad.crear', compact("discapacidad"));
    }
    public function guardar(Request $request)
    {
        $request->validate(Discapacidad::$rules);
        $input = $request->all();
        $discapacidadDescripcion = Discapacidad::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($discapacidadDescripcion!=null) {
            Flash("Esta discapacidad «".$discapacidadDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/discapacidad/crear");
        }
        try {
            Discapacidad::create([
                'descripcion' => $input['descripcion'],
                'link' => $input['link'],
                'estado' => 1,
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/discapacidad");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/discapacidad/crear");
        }
    }
    public function editar($id)
    {
        $discapacidad = Discapacidad::find($id);
        if ($discapacidad==null) {
            Flash('Esa discapacidad no está registrada en el sistema')->error();
            return redirect("/discapacidad");
        }
        return view("discapacidad.editar", compact("discapacidad"));
    }
    public function modificar(Request $request) 
    {
        $discapacidad=Discapacidad::find($request->id);
        if ($discapacidad==null) {
            Flash('Esa discapacidad no está registrada en el sistema')->error();
            return back();
        }
        $discapacidadDescripcion = Discapacidad::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($discapacidadDescripcion!=null) {
            Flash("Esta discapacidad «".$discapacidadDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/discapacidad/editar/$request->id");
        }
        $request->validate(Discapacidad::$rules);
        $input = $request->all();
        try {
            $discapacidad->update([
                'descripcion' => $input['descripcion'],
                'link' => $input['link'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/discapacidad");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/discapacidad/editar/{$request->id}");
        }
    }
    public function ver($id)
    {
        $discapacidad = Discapacidad::find($id);
        return compact("discapacidad");
    }
    public function modificarEstado($id, $estado)
    {
        $discapacidad = Discapacidad::find($id);
        if ($discapacidad == null) {
            Flash("No se puede modificar el estado de esta discapacidad")->error();
            return redirect("/discapacidad");
        }
        try {
            $discapacidad->update([
                "estado" => $estado,
            ]);
            Flash("Se modificó el estado correctamente")->success();
            return redirect("/discapacidad");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/discapacidad");
        }
    }
}

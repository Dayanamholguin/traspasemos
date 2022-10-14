<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Flash;
use App\Models\institucion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class institucionController extends Controller
{
    public function index()
    {
        return view('institucion.index');
    }

    public function listar(Request $request)
    {
        $institucion = institucion::select("institucion.*", "ciudad.descripcion as ciudad")
            ->join("ciudad", "institucion.idCiudad", "ciudad.id")
            ->get();
            return DataTables::of($institucion)
            ->editColumn("estado", function ($institucion) {
                return $institucion->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($institucion) {
                $acciones = '<a href="/institucion/editar/' . $institucion->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarVentana(' . $institucion->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // if ($institucion->id!=2) {
                    if ($institucion->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/institucion/cambiar/estado/' . $institucion->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/institucion/cambiar/estado/' . $institucion->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $ciudad = DB::table('ciudad')->get();
        return view('institucion.crear', compact("ciudad"));
    }
    public function guardar(Request $request)
    {
        $request->validate(institucion::$rules);
        $input = $request->all();
        try {
            institucion::create([
                'nombre' => $input['nombre'],
                'nit' => $input['nit'],
                'docDane' => $input['docDane'],
                'direccion' => $input['direccion'],
                'telefono' => $input['telefono'],
                'nombreRector' => $input['nombreRector'],
                'idCiudad' => $input['idCiudad'],
                'estado' => 1,
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/institucion");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/institucion/crear");
        }
    }
    public function editar($id)
    {
        $ciudad = DB::table('ciudad')->get();
        $institucion = institucion::find($id);
        if ($institucion==null) {
            Flash('Esa institucion no está registrada en el sistema')->error();
            return redirect("/institucion");
        }
        return view("institucion.editar", compact("institucion", "ciudad"));
    }

    public function modificar(Request $request) 
    {
        $institucion=institucion::find($request->id);
        if ($institucion==null) {
            Flash('Esa institucion no está registrada en el sistema')->error();
            return back();
        }

        $institucionNombre = institucion::select('*')->where('nombre',$request->nombre)->where('id','<>',$request->id)->value('nombre');        
        if ($institucionNombre!=null) {
            Flash("Este número de documento «".$institucionNombre."» ya está en uso")->error();
            return redirect("/institucion/editar/$request->id");
        }
        $request->validate(institucion::$rules);
        $input = $request->all();
        
        try {
            $institucion->update([
                'nombre' => $input['nombre'],
                'nit' => $input['nit'],
                'docDane' => $input['docDane'],
                'direccion' => $input['direccion'],
                'telefono' => $input['telefono'],
                'nombreRector' => $input['nombreRector'],
                'idCiudad' => $input['idCiudad'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/institucion");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/institucion/editar/{$request->id}");
        }
    }

    public function ver($id)
    {
        
        $institucion = institucion::find($id);
        $ciudad = DB::table('ciudad')->join("institucion", "institucion.idCiudad", "ciudad.id")->where("institucion.id", $institucion->id)->value('descripcion');
        return compact("institucion", "ciudad");
    }
    
    public function modificarEstado($id, $estado)
    {
        $institucion = institucion::find($id);
        if ($institucion == null) {
            Flash("No se puede modificar el estado de esta institucion")->error();
            return redirect("/institucion");
        }
        try {
            $institucion->update([
                "estado" => $estado,
            ]);
            return redirect("/institucion");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/institucion");
        }
    }
}

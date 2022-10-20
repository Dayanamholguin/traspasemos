<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Flash;
use App\Models\NEE;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class neeController extends Controller
{
    public function index()
    {
        return view('nee.index');
    }

    public function listar(Request $request)
    {
        $nee = NEE::all();
            return DataTables::of($nee)
            ->editColumn("estado", function ($nee) {
                return $nee->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($nee) {
                $acciones = '<a href="/nee/editar/' . $nee->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarnee(' . $nee->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // if ($nee->id!=2) {
                    if ($nee->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/nee/cambiar/estado/' . $nee->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/nee/cambiar/estado/' . $nee->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $nee = NEE::select('*')->orderBy('id', 'desc')->first();
        return view('nee.crear', compact("nee"));
    }
    public function guardar(Request $request)
    {
        $request->validate(NEE::$rules);
        $input = $request->all();
        $neeNombre = NEE::select('*')->where('nombre',$request->nombre)->where('id','<>',$request->id)->value('nombre');        
        if ($neeNombre!=null) {
            Flash("Esta NEE «".$neeNombre."» ya está en uso, intente nuevamente")->error();
            return redirect("/nee/crear");
        }
        
        try {
            NEE::create([
                'nombre' => $input['nombre'],
                'descripcion' => $input['descripcion'],
                'link' => $input['link'],
                'estado' => 1,
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/nee");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/nee/crear");
        }
    }
    public function editar($id)
    {
        $nee = NEE::find($id);
        if ($nee==null) {
            Flash('Esa NEE no está registrada en el sistema')->error();
            return redirect("/nee");
        }
        return view("nee.editar", compact("nee"));
    }
    public function modificar(Request $request) 
    {
        $nee=NEE::find($request->id);
        if ($nee==null) {
            Flash('Esa NEE no está registrada en el sistema')->error();
            return back();
        }
        $neeDescripcion = NEE::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($neeDescripcion!=null) {
            Flash("Esta NEE «".$neeDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/nee/editar/$request->id");
        }
        $request->validate(NEE::$rules);
        
        $input = $request->all();
        try {
            $nee->update([
                'nombre' => $input['nombre'],
                'descripcion' => $input['descripcion'],
                'link' => $input['link'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/nee");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/nee/editar/{$request->id}");
        }
    }
    public function ver($id)
    {
        $nee = NEE::find($id);
        return compact("nee");
    }
    public function modificarEstado($id, $estado)
    {
        $nee = NEE::find($id);
        if ($nee == null) {
            Flash("No se puede modificar el estado del NEE")->error();
            return redirect("/nee");
        }
        try {
            $nee->update([
                "estado" => $estado,
            ]);
            Flash("Se modificó el estado correctamente")->success();
            return redirect("/nee");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/nee");
        }
    }
}

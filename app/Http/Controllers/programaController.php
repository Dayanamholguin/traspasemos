<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use DataTables;
use App\Models\Programa;

class programaController extends Controller
{
    public function index()
    {
        return view('programa.index');
    }

    public function listar(Request $request)
    {
        $programa = programa::all();
            return DataTables::of($programa)
            ->editColumn("estado", function ($programa) {
                return $programa->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($programa) {
                $acciones = '<a href="/programa/editar/' . $programa->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarprograma(' . $programa->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // if ($programa->id!=2) {
                    if ($programa->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/programa/cambiar/estado/' . $programa->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/programa/cambiar/estado/' . $programa->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $programa = programa::select('*')->orderBy('id', 'desc')->first();
        return view('programa.crear', compact("programa"));
    }
    public function guardar(Request $request)
    {
        $request->validate(programa::$rules);
        $input = $request->all();
        $programaDescripcion = programa::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($programaDescripcion!=null) {
            Flash("Este programa «".$programaDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/programa/crear");
        }
        try {
            programa::create([
                'descripcion' => $input['descripcion'],
                'link' => $input['link'],
                'version' => $input['version'],
                'estado' => 1,
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/programa");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/programa/crear");
        }
    }
    public function editar($id)
    {
        $programa = programa::find($id);
        if ($programa==null) {
            Flash('Este programa no está registrado en el sistema')->error();
            return redirect("/programa");
        }
        return view("programa.editar", compact("programa"));
    }
    public function modificar(Request $request) 
    {
        $programa=programa::find($request->id);
        if ($programa==null) {
            Flash('Ese programa no está registrada en el sistema')->error();
            return back();
        }
        $programaDescripcion = programa::select('*')->where('descripcion',$request->descripcion)->where('id','<>',$request->id)->value('descripcion');        
        if ($programaDescripcion!=null) {
            Flash("Esta programa «".$programaDescripcion."» ya está en uso, intente nuevamente")->error();
            return redirect("/programa/editar/$request->id");
        }
        $request->validate(programa::$rules);
        $input = $request->all();
        try {
            $programa->update([
                'descripcion' => $input['descripcion'],
                'link' => $input['link'],
                'version' => $input['version'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/programa");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/programa/editar/{$request->id}");
        }
    }
    public function ver($id)
    {
        $programa = programa::find($id);
        return compact("programa");
    }
    public function modificarEstado($id, $estado)
    {
        $programa = programa::find($id);
        if ($programa == null) {
            Flash("No se puede modificar el estado de este programa")->error();
            return redirect("/programa");
        }
        try {
            $programa->update([
                "estado" => $estado,
            ]);
            Flash("Se modificó el estado correctamente")->success();
            return redirect("/programa");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/programa");
        }
    }
}

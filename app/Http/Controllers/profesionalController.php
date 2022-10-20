<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;
use DataTables;
use Flash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class profesionalController extends Controller
{
    public function index()
    {
        return view('profesional.index');
    }

    public function listar(Request $request)
    {
        $profesional = Profesional::select("profesional.*", "tipoDocumento.abreviatura as tipoDocumento")
            ->join("tipoDocumento", "profesional.idTipoDocumento", "tipoDocumento.id")
            ->get();
            return DataTables::of($profesional)
            ->editColumn("estado", function ($profesional) {
                return $profesional->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($profesional) {
                $acciones = '<a href="/profesional/editar/' . $profesional->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarVentana(' . $profesional->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // if ($profesional->id!=2) {
                    if ($profesional->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/profesional/cambiar/estado/' . $profesional->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/profesional/cambiar/estado/' . $profesional->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
                    }
                // }
                return $acciones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear()
    {
        $tipoDocumento = DB::table('tipoDocumento')->get();
        return view('profesional.crear', compact("tipoDocumento"));
    }
    public function guardar(Request $request)
    {
        $request->validate(Profesional::$rules);
        $input = $request->all();
        try {
            Profesional::create([
                'nombreProfesional' => $input['nombreProfesional'],
                'apellidoProfesional' => $input['apellidoProfesional'],
                'telefono' => $input['telefono'],
                'email' => $input['email'],
                'numeroDocumentoProfesional' => $input['numeroDocumentoProfesional'],
                'idTipoDocumento' => $input['idTipoDocumento'],
                'estado' => 1,
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/profesional");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/profesional/crear");
        }
    }
    public function editar($id)
    {
        $profesional = Profesional::find($id);
        if ($profesional==null) {
            Flash('Ese profesional no está registrado en el sistema')->error();
            return redirect("/profesional");
        }
        $tipoDocumento = DB::table('tipoDocumento')->get();
        return view("profesional.editar", compact("profesional", "tipoDocumento"));
    }

    public function modificar(Request $request) 
    {
        $profesional=Profesional::find($request->id);
        if ($profesional==null) {
            Flash('Ese profe$profesional no está registrado en el sistema')->error();
            return back();
        }
        $correo = Profesional::select('*')->where('email',$request->email)->where('id','<>',$request->id)->value('email');
        if ($correo!=null) {
            Flash("El correo ".$correo." ya está creado, intente con otro correo nuevamente")->error();
            return redirect("/profesional/editar/{$request->id}");
        }
        $profesionalNumero = Profesional::select('*')->where('numeroDocumentoProfesional',$request->numeroDocumentoProfesional)->where('id','<>',$request->id)->value('numeroDocumentoProfesional');        
        if ($profesionalNumero!=null) {
            Flash("Este número de documento «".$profesionalNumero."» ya está en uso")->error();
            return redirect("/profesional/editar/$request->id");
        }
        $profesional = Profesional::select("*")->where("email", $request->email)->first();
        if ($profesional != null) {
            $campos = [
                'nombreProfesional' => ['required', 'string', 'max:255'],
                'apellidoProfesional' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $profesional->id],
                'numeroDocumentoProfesional' => ['required', 'numeric'],                
                'telefono' => ['required', 'numeric'],
                'idTipoDocumento' => ['required', 'exists:tipoDocumento,id'],
            ];
            $this->validate($request, $campos);
        } else {
            $campos = [
                'nombreProfesional' => ['required', 'string', 'max:255'],
                'apellidoProfesional' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'numeroDocumentoProfesional' => ['required', 'numeric'],                
                'telefono' => ['required', 'numeric'],
                'idTipoDocumento' => ['required', 'exists:tipoDocumento,id'],
            ];
            $this->validate($request, $campos);
            $profesional=Profesional::find($request->id);
        }
        $input = $request->all();
        
        try {
            $profesional->update([
                'nombreProfesional' => $input['nombreProfesional'],
                'apellidoProfesional' => $input['apellidoProfesional'],
                'telefono' => $input['telefono'],
                'email' => $input['email'],
                'numeroDocumentoProfesional' => $input['numeroDocumentoProfesional'],
                'idTipoDocumento' => $input['idTipoDocumento'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/profesional");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/profesional/editar/{$request->id}");
        }
    }

    public function ver($id)
    {
        $profesional = Profesional::find($id);
        $tipoDocumento = DB::table('tipoDocumento')->join("users", "users.idTipoDocumento", "tipoDocumento.id")->where("users.id", $usuario->id)->value('descripcion');
        return compact("profesional", "tipoDocumento");
    }
    
    public function modificarEstado($id, $estado)
    {
        $profesional = Profesional::find($id);
        if ($profesional == null) {
            Flash("No se puede modificar el estado de este profesional")->error();
            return redirect("/profesional");
        }
        try {
            $profesional->update([
                "estado" => $estado,
            ]);
            return redirect("/profesional");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/profesional");
        }
    }
}

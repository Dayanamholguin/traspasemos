<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Flash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    public function index()
    {
        return view('usuario.index');
    }

    public function listar(Request $request)
    {
        $usuario = User::select("users.*", "tipoDocumento.abreviatura as tipoDocumento", "tipoUsuario.descripcion as tipoUsuario")
            ->join("tipoDocumento", "users.idTipoDocumento", "tipoDocumento.id")
            ->join("tipoUsuario", "users.idTipoUsuario", "tipoUsuario.id")
            // ->where("users.id", ">", 2)
            ->get();
            return DataTables::of($usuario)
            ->editColumn("estado", function ($usuario) {
                return $usuario->estado == 1 ? "Activo" : "Inactivo";
            })
            ->addColumn('acciones', function ($usuario) {
                $acciones = '<a href="/usuario/editar/' . $usuario->id . '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a> ';
                $acciones .= '<a style="color:gray;"  href="javascript:void(0)" onclick="mostrarVentana(' . $usuario->id . ')" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-info-circle"></i></a> ';
                // if ($usuario->id!=2) {
                    if ($usuario->estado == 1) {
                        $acciones .= '<a style="color:green;" href="/usuario/cambiar/estado/' . $usuario->id . '/0" data-toggle="tooltip" data-placement="top" title="Inactivar"><i class="fas fa-toggle-on"></i></a>';
                    } else {
                        $acciones .= '<a style="color:red;" href="/usuario/cambiar/estado/' . $usuario->id . '/1" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fas fa-toggle-off"></i></a>';
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
        $tipoUsuario = DB::table('tipoUsuario')->get();
        return view('usuario.crear', compact("tipoDocumento", "tipoUsuario"));
    }
    public function guardar(Request $request)
    {
        $request->validate(User::$rules);
        $input = $request->all();
        try {
            User::create([
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'numeroDocumento' => $input['numeroDocumento'],
                'estado' => 1,
                'idTipoDocumento' => $input['idTipoDocumento'],
                'idTipoUsuario' => $input['idTipoUsuario'],
                'password' => Hash::make(substr(md5(time()), 0, 16)),
            ]);
            Flash("Se ha creado éxitosamente")->success()->important();
            return redirect("/usuario");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/usuario/crear");
        }
    }
    public function editar($id)
    {
        $tipoDocumento = DB::table('tipoDocumento')->get();
        $tipoUsuario = DB::table('tipoUsuario')->get();
        $usuario = User::find($id);
        if ($usuario==null) {
            Flash('Ese usuario no está registrado en el sistema')->error();
            return redirect("/usuario");
        }
        return view("usuario.editar", compact("usuario", "tipoDocumento", "tipoUsuario"));
    }

    public function modificar(Request $request) 
    {
        $usuario=User::find($request->id);
        if ($usuario==null) {
            Flash('Ese usuario no está registrado en el sistema')->error();
            return back();
        }
        $correo = User::select('*')->where('email',$request->email)->where('id','<>',$request->id)->value('email');
        if ($correo!=null) {
            Flash("El correo ".$correo." ya está creado, intente con otro correo nuevamente")->error();
            return redirect("/usuario/editar/{$request->id}");
        }
        $usuarioNumero = User::select('*')->where('numeroDocumento',$request->numeroDocumento)->where('id','<>',$request->id)->value('numeroDocumento');        
        if ($usuarioNumero!=null) {
            Flash("Este número de documento «".$usuarioNumero."» ya está en uso")->error();
            return redirect("/usuario/editar/$request->id");
        }
        $usuario = User::select("*")->where("email", $request->email)->first();
        if ($usuario != null) {
            $campos = [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
                'numeroDocumento' => ['required', 'numeric'],
                'idTipoDocumento' => ['required', 'exists:tipoDocumento,id'],
                'idTipoUsuario' => ['required', 'exists:tipoUsuario,id'],
            ];
            $this->validate($request, $campos);
        } else {
            $campos = [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'numeroDocumento' => ['required', 'numeric'],
                'idTipoDocumento' => ['required', 'exists:tipoDocumento,id'],
                'idTipoUsuario' => ['required', 'exists:tipoUsuario,id'],
            ];
            $this->validate($request, $campos);
            $usuario=User::find($request->id);
        }
        $input = $request->all();
        
        try {
            $usuario->update([
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'numeroDocumento' => $input['numeroDocumento'],
                'idTipoDocumento' => $input['idTipoDocumento'],
                'idTipoUsuario' => $input['idTipoUsuario'],
            ]); 
            Flash("Se ha modificado éxitosamente")->success();
            return redirect("/usuario");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error();
            return redirect("/usuario/editar/{$request->id}");
        }
    }

    public function ver($id)
    {
        $usuario = User::find($id);
        $tipoDocumento = DB::table('tipoDocumento')->join("users", "users.idTipoDocumento", "tipoDocumento.id")->where("users.id", $usuario->id)->value('descripcion');
        $tipoUsuario = DB::table('tipoUsuario')->join("users", "users.idTipoUsuario", "tipoUsuario.id")->where("users.id", $usuario->id)->value('descripcion');
        return compact("usuario", "tipoDocumento", "tipoUsuario");
    }
    
    public function modificarEstado($id, $estado)
    {
        $usuario = User::find($id);
        if ($usuario == null) {
            Flash("No se puede modificar el estado de este usuario")->error();
            return redirect("/usuario");
        }
        try {
            $usuario->update([
                "estado" => $estado,
            ]);
            return redirect("/usuario");
        } catch (\Exception $e) {
            Flash($e->getMessage())->error()->important();
            return redirect("/usuario");
        }
    }
}

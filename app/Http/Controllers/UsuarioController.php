<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller{
    public function index(){
        $datosUsuario = Usuario::all();

        return response()->json($datosUsuario);
    }

    public function show($username){
        $datosUsuario = new Usuario();
        $datosEncontrados = $datosUsuario->find($username);

        return response()->json($datosEncontrados);
    }

    public function store(Request $request){
        $datosUsuario = new Usuario();

        $datosUsuario->NombreUsuario=$request->nombreusuario;
        $datosUsuario->Nombre=$request->nombre;
        $datosUsuario->Email=$request->email;
        $datosUsuario->Telefono=$request->telefono;
        $datosUsuario->Estado=$request->estado;
        $datosUsuario->Municipio=$request->municipio;
        $datosUsuario->save();

        return response()->json($datosUsuario);
    }

    public function update(Request $request, $username){
        $datosUsuario=Usuario::find($username);

        /*if($request->input('nombreusuario')){
            $datosUsuario->NombreUsuario=$request->input('nombreusuario');
        }*/
        if($request->input('nombre')){
            $datosUsuario->Nombre=$request->input('nombre');
        }
        if($request->input('email')){
            $datosUsuario->Email=$request->input('email');
        }
        if($request->input('telefono')){
            $datosUsuario->Telefono=$request->input('telefono');
        }
        if($request->input('estado')){
            $datosUsuario->Estado=$request->input('estado');
        }
        if($request->input('municipio')){
            $datosUsuario->Municipio=$request->input('municipio');
        }
        $datosUsuario->save();
        return response()->json($datosUsuario);
    }

    public function destroy($username){
        $datosUsuario=Usuario::find($username);

        $datosUsuario->delete();

        return response("Borrado");
    }
}
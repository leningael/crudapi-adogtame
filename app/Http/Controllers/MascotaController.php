<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;

use Carbon\Carbon;

class MascotaController extends Controller{
    public function index(){
        $datosMascota = Mascota::all();

        return response()->json($datosMascota);
    }

    public function show($id){
        $datosMascota = new Mascota();
        $datosEncontrados = $datosMascota->find($id);

        return response()->json($datosEncontrados);
    }

    public function store(Request $request){
        $datosMascota = new Mascota();

        if($request->hasFile('imagen')){
            $nombreArchivoOriginal=$request->file('imagen')->getClientOriginalName();

            $nuevoNombre= Carbon::now()->timestamp."_".$nombreArchivoOriginal;

            $carpetaDestino='./upload/';

            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosMascota->NombreUsuario=$request->nombreusuario;
            $datosMascota->Nombre=$request->nombre;
            $datosMascota->Edad=$request->edad;
            $datosMascota->Peso=$request->peso;
            $datosMascota->Tamano=$request->tamano;
            $datosMascota->Especie=$request->especie;
            $datosMascota->Raza=$request->raza;
            $datosMascota->Imagen=ltrim($carpetaDestino, '.').$nuevoNombre;
            $datosMascota->Descripcion=$request->descripcion;

            $datosMascota->save();
        }

        return response()->json($nuevoNombre);
    }

    public function update(Request $request, $id){
        $datosMascota=Mascota::find($id);

        if($request->hasFile('imagen')) {
            if($datosMascota){
                $rutaArchivo=base_path('public').$datosMascota->Imagen;
                if(file_exists($rutaArchivo)){
                    unlink($rutaArchivo);
                }
            }
            $nombreArchivoOriginal=$request->file('imagen')->getClientOriginalName();
            $nuevoNombre= Carbon::now()->timestamp."_".$nombreArchivoOriginal;
            $carpetaDestino='./upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);
            $datosMascota->Imagen=ltrim($carpetaDestino, '.').$nuevoNombre;
        }

        if($request->input('nombreusuario')){
            $datosMascota->NombreUsuario=$request->input('nombreusuario');
        }
        if($request->input('nombre')){
            $datosMascota->Nombre=$request->input('nombre');
        }
        if($request->input('edad')){
            $datosMascota->Edad=$request->input('edad');
        }
        if($request->input('peso')){
            $datosMascota->Peso=$request->input('peso');
        }
        if($request->input('tamano')){
            $datosMascota->Tamano=$request->input('tamano');
        }
        if($request->input('especie')){
            $datosMascota->Especie=$request->input('especie');
        }
        if($request->input('raza')){
            $datosMascota->Raza=$request->input('raza');
        }
        if($request->input('descripcion')){
            $datosMascota->Descripcion=$request->input('descripcion');
        }
        $datosMascota->save();
        return response()->json($datosMascota);
    }

    public function destroy($id){
        $datosMascota=Mascota::find($id);

        if($datosMascota){
            $rutaArchivo=base_path('public').$datosMascota->Imagen;
            if(file_exists($rutaArchivo)){
                unlink($rutaArchivo);
            }

            $datosMascota->delete();
        }

        return response("Borrado");
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

use Carbon\Carbon;

class ArticuloController extends Controller{
    public function index(){
        $datosArticulo = Articulo::all();

        return response()->json($datosArticulo);
    }

    public function recentUpdates($max_results = null){

        if($max_results){
            $datosArticulo = Articulo::orderBy('updated_at', 'desc')->take($max_results)->get();
        }else{
            $datosArticulo = Articulo::orderBy('updated_at', 'desc')->get();
        }

        return response()->json($datosArticulo);
    }

    public function show($id){
        $datosArticulo = new Articulo();
        $datosEncontrados = $datosArticulo->find($id);

        return response()->json($datosEncontrados);
    }

    public function store(Request $request){
        $datosArticulo = new Articulo();

        if($request->hasFile('imagen')){
            $nombreArchivoOriginal=$request->file('imagen')->getClientOriginalName();

            $nuevoNombre= Carbon::now()->timestamp."_".$nombreArchivoOriginal;

            $carpetaDestino='./upload/';

            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosArticulo->Autor=$request->autor;
            $datosArticulo->Titulo=$request->titulo;
            $datosArticulo->Anio=$request->anio;
            $datosArticulo->Resumen=$request->resumen;
            $datosArticulo->Contenido=$request->contenido;
            $datosArticulo->Imagen=ltrim($carpetaDestino, '.').$nuevoNombre;

            $datosArticulo->save();
        }

        return response()->json($nuevoNombre);
    }

    public function update(Request $request, $id){
        $datosArticulo=Articulo::find($id);

        if($request->hasFile('imagen')) {
            if($datosArticulo){
                $rutaArchivo=base_path('public').$datosArticulo->Imagen;
                if(file_exists($rutaArchivo)){
                    unlink($rutaArchivo);
                }
            }
            $nombreArchivoOriginal=$request->file('imagen')->getClientOriginalName();
            $nuevoNombre= Carbon::now()->timestamp."_".$nombreArchivoOriginal;
            $carpetaDestino='./upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);
            $datosArticulo->Imagen=ltrim($carpetaDestino, '.').$nuevoNombre;
        }

        if($request->input('autor')){
            $datosArticulo->Autor=$request->input('autor');
        }
        if($request->input('titulo')){
            $datosArticulo->Titulo=$request->input('titulo');
        }
        if($request->input('anio')){
            $datosArticulo->Anio=$request->input('anio');
        }
        if($request->input('resumen')){
            $datosArticulo->Resumen=$request->input('resumen');
        }
        if($request->input('contenido')){
            $datosArticulo->Contenido=$request->input('contenido');
        }

        $datosArticulo->save();
        return response()->json($datosArticulo);
    }

    public function destroy($id){
        $datosArticulo=Articulo::find($id);

        if($datosArticulo){
            $rutaArchivo=base_path('public').$datosArticulo->Imagen;
            if(file_exists($rutaArchivo)){
                unlink($rutaArchivo);
            }

            $datosArticulo->delete();
        }

        return response("Borrado");
    }
}

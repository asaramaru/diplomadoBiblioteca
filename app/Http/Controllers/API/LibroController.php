<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Libros;

class LibroController extends Controller
{
    //Listar todo de la api
    public function get(){
        try {
            $data = Libros::get();
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(["error"=>$th->getMessage()],500);
        }
    }

    //Listar por un registro
    public function getById($id){
        try {
            $data = Libros::find($id);
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(["error"=>$th->getMessage()],500);
        }
    }

    //buscador por cualquier filtro
    public function filter(Request $request){
        try {
            $title = $request->get("title");
            //$data = Libros::get()->where('titulo','LIKE',"%$title%")->get();
            $data = Libros::when($title, function ($query) use ($title) {
                return $query->where('titulo', 'LIKE', "%$title%");
            })->get();
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(["error"=>$th->getMessage()],500);
        }
    }

    //crear libro
    public function create(Request $request){
        try {
            $data['autor'] = $request['autor'];
            $data['titulo'] = $request['titulo'];
            $data['genero'] = $request['genero'];
            $data['descripcion'] = $request['descripcion'];
            $data['publicacion'] = $request['publicacion'];

            $res = Libros::create($data);
            return response()->json($res,200);
        } catch (\Throwable $th) {
            return response()->json(["error"=>$th->getMessage()],500);
        }
    }

    public function update(Request $request, $id){
        try {
            $data['autor'] = $request['autor'];
            $data['titulo'] = $request['titulo'];
            $data['genero'] = $request['genero'];
            $data['descripcion'] = $request['descripcion'];
            $data['publicacion'] = $request['publicacion'];

            Libros::find($id)->update($data);
            $res = Libros::find($id);
            return response()->json($res,200);
        } catch (\Throwable $th) {
            return response()->json(["error"=>$th->getMessage()],500);
        }
    }

    public function delete($id){
        try {
            $res = Libros::find($id)->delete();
            return response()->json(["El libro fue eliminado con exito" => $res],200);
        } catch (\Throwable $th) {
            return response()->json(["error"=>$th->getMessage()],500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Requisito;
use App\Models\Tramite;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequirementsController extends Controller
{
 public function create(Request $request){

    $validator = Validator::make($request->all(),[
        'name' => 'string|required|max:255|min:2|unique:requisitos',
           'tipo_de_tramite_id' => 'required|integer'
    ]);
    if ($validator->fails()) {
        // Maneja los errores de validación
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    $tramite = Tramite::find($request->tipo_de_tramite_id);

    if (!$tramite) {
        return response()->json([
            'messages' => 'A resource with the id could not be found: ' . $request->tipo_de_tramite_id
        ], 422);
    }



        Requisito::create([
            'name' => $request->name,
            'tipo_de_tramites_id' => $request->tipo_de_tramite_id
        ]);


        return response()->json([
            'success' => 'requirement created'
        ],201);







 }

 public function update(Request $request , $id){

    $validator = Validator::make($request->all(),[
        'name' => 'string|required|max:255|min:2',
           'tipo_de_tramite_id' => 'required|integer'
    ]);
    if ($validator->fails()) {
        // Maneja los errores de validación
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }



    $requirement = Requisito::find($id);

    if (!$requirement) {
       return response()->json([
            'messages' => 'A resource with the id could not be found: ' . $id
       ], 422);
    }

    $requirement->update([
        'name' => $request->name,
        'tipo_de_tramites_id' => $request->tipo_de_tramite_id
    ]);

    return response()->json([
        'message' => 'requirement updated successfully'
    ]);


 }
public function delete($id){
    $requirement = Requisito::find($id);

    if (!$requirement) {
       return response()->json([
            'messages' => 'A resource with the id could not be found: ' . $id
       ], 422);
    }

    if ($requirement->tipo_de_tramites_id) {
        return response()->json([
            'message' => 'The requirement cannot be eliminated since it has a type of procedure'
        ], 422);
        # code...
    }
    $requirement->delete();
    return response()->json([
        'message' => 'requirement deleted successfully'
    ]);

}


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeOfProceduresStore;
use App\Models\TipoDeTramite;
use App\Models\Tramite;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeOfProcedures extends Controller
{
    public function create(TypeOfProceduresStore $request)
{
    try {
        // Crear el procedimiento
        $procedures = TipoDeTramite::create([
            'name' => $request->name,
            'comments' => $request->comments,
        ]);

        return response()->json([
            'success' => 'Procedure created successfully'
        ], 201); // Código 201 para creación exitosa

    } catch (\Exception $e) {
        // Captura de cualquier excepción general
        return response()->json([
            'error' => 'Failed to create procedure',
            'message' => $e->getMessage()
        ], 201); // Código 500 para errores del servidor
    }
}
    public function update( Request $request, $id ){


       $validator = Validator::make($request->all(),[
          'name' => 'required|max:255|string',
            'comments' => 'required|string'
       ]);

       if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()
            ], 422);
       }
       $typeOfProcedures = TipoDeTramite::find($id);

       if (!$typeOfProcedures) {
            return response()->json([
                'messages' =>  'A resource with the id could not be found' . ' ' . $id
            ], 422);
       }
       $typeOfProcedures->update([
            'name' => $request->name,
            'comments' => $request->comments
       ]);
       return response([
            'messages' => 'the type of procedure with the id' . ' ' . $id . ' ' . 'was updated successfully'
       ]);
    }
        public function delete($id){
            $typeOfProcedures = TipoDeTramite::find($id);

            if (!$typeOfProcedures) {
                return response()->json([
                    'messages' =>  'A resource with the id could not be found' . ' ' . $id
                ], 422);
           }

           $procedures = Tramite::where('tipo_de_tramite_id', $id)->get();

           if (!$procedures->isEmpty()) {  // Verifica si la colección NO está vacía
            return response()->json([
                'messages' => 'The type of procedure cannot be deleted since it has procedures done with the same'
            ], 422);
        }

        $typeOfProcedures->delete();


        return response()->json([
            'messages' => 'type of procedure eliminated'
        ]);

     }
}

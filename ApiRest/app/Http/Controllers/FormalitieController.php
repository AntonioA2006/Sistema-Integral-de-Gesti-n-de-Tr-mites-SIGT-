<?php

namespace App\Http\Controllers;

use App\Models\TipoDeTramite;
use App\Models\Tramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormalitieController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'tipo_de_tramite_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            // Maneja los errores de validación
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

       try {
        $FkType = TipoDeTramite::findOrFail($request->tipo_de_tramite_id)->id;


        Tramite::create([
            'tipo_de_tramite_id' => $FkType
        ]);


        return response()->json([
            'success' => 'Formalitite created'
        ],201);

       }catch (\Exception $e) {
        // Captura de cualquier excepción general
        return response()->json([
            'error' => 'Failed to create procedure',
            'message' => $e->getMessage()
        ], 401); // Código 500 para errores del servidor
    }
    }
}

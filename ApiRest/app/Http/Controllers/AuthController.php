<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Section;
use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar las credenciale
        try {

            $validator = Validator::make($request->all(), [
                'curp' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
            // Intentar autenticar al usuario usando el modelo UserManagement
            $user = UserManagement::where('curp', $request->curp)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            $section =Section::find($user->section_id);
            $role = Role::find($section->roles_id)->role_name;

            return response()->json( [
                'tipe' => 'Bearer',
                'token' => $token,
                'message' => 'Login successfully',
                'section' => ($section->section_name),
                'role' => $role,
                'user' => $user->name . " " . $user->first_name . " " .  $user->last_name

            ]);
        }
        catch (\Throwable $th) {
            // Retornar un mensaje de error genérico o específico
            return response()->json([
                'message' => 'An error occurred',
                'error' => $th->getMessage() // Puedes quitar esto en producción por seguridad
            ], 500);
        }
    }
}

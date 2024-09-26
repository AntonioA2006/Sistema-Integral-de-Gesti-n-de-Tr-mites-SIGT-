<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'role_name' => 'required|unique:roles'
        ]);

        if ($validator->fails()) {
             return response()->json([
                'errors' => $validator->errors()
             ], 422);
        }
        $role = Role::create([
            'role_name' => $request->role_name
        ]);


        if ($role) {
            return response()->json([
                'success' => 'role hasbend created'
            ], 201);
        }

    }
}

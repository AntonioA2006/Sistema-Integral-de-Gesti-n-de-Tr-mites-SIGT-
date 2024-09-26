<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
   public function create(Request $request){
        $validator  = Validator::make($request->all(), [
            'section_name' => 'required|unique:sections',
            'roles_id' =>  'required|exists:roles,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }


        $section = Section::create([
            'section_name' => $request->section_name,
            'roles_id' => $request->roles_id
        ]);

        if (!$section) {
            return response()->json([
                'error' => 'Failed to create resource'
            ],422);
        }
        return response()->json(['success' => 'sections hasbend created'], 201);
   }
}

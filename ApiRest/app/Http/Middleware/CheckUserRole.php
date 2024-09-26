<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\Section;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles): Response
    {
        $user = Auth::user();



        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        if ($user->actived === 0) {
            return response()->json(['message' => 'User is disabled'], Response::HTTP_UNAUTHORIZED);
        }
        $roles = Role::findOrFail(Section::findOrFail($user->section_id)->roles_id)->role_name;



        $user_section = Section::find($user->section_id);
        $user_role = Role::find($user_section->roles_id);
        // Si el rol del usuario no está dentro de los roles permitidos
        if (!in_array($roles,  $allowedRoles)) {
            return response()->json([
                'message' => 'You do not have the role allowed to modify your role and section are as follows, contact an Administrator',
                'section' =>$user_section->section_name,
                'role' => $user_role->role_name
            ], 421);
        }

        // Si el usuario tiene uno de los roles permitidos, continúa con la solicitud
        return $next($request);
    }
}

<?php



namespace App\Http\Controllers;

use App\Http\Requests\UserCreateStore;
use App\Http\Requests\UserUpdatedStore;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Section;
use App\Models\UserManagement;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

use function Pest\Laravel\json;

class UserManagementController extends Controller
{


   public function create_user(  UserCreateStore $request )
   {

    //debemos cr4ar un default para cada ususario

    try {



       $user  =  UserManagement::create([
            'curp' => $request->curp,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'birthdate'=> $request->birthdate,
            'state' => $request->state,
            'city' => $request->city,
             'section_id' => 1,
             'password' => Hash::make($request->curp)
        ]);

        $token = $user->createToken('api')->plainTextToken;


        return response()->json([
           'user_created' => 'success',
           'code' => http_response_code(201),
           'access_token' =>  $token,
           'token_type' => 'Bearer'
        ]);
    } catch (\Throwable $th) {

        return response()->json([
            'error' => $th->getMessage()
        ],422);


        }
    }


    public function updated_user($id, UserUpdatedStore $request){

        try {
            $user  = UserManagement::findOrFail($id);

            $user->update($request->all());


            return response()->json([
                'user' => $user
            ]);

            //
        } catch (ModelNotFoundException  $th) {
            return response()->json([
                'error' => 'error'
            ], 404);

        }
    }
    public function show(){
        return response()->json([
            'user' => UserManagement::all()
        ]);
    }
    public function show_only($id){

        try {
            $user  = UserManagement::findOrFail($id);


        return response()->json([
            'user' => $user
        ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'error' => 'user not found'
            ], 404);

        }


    }
    public function disabled_state($id){

        try {
            $user = UserManagement::findOrFail($id);
        if ($user->actived == 1) {
            $user->actived = 0 ;
        }else{
            $user->actived = 1 ;

        }
        $user->save();


        return response()->json([
            'success' => $user->actived == 1  ? 'user activated' : 'user disables'
        ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'error' => 'user not found'
            ], 404);
        }

    }
    public function delete($id, $curp){
            try {
                $user = UserManagement::findOrFail($id);

                if ($user->curp !== $curp ) {
                    return response()->json([
                        'error' => "You must enter a CURP equal to that of the user"
                    ], 400);
                }

                $user->delete();



                 return response()->json([
                'success' => "user delete"
                ]);







            } catch (ModelNotFoundException $th) {
                return response()->json([
                    'error' => 'user not found'
                ], 404);
            }
    }
    public function test(){
        return response('test..');
    }
}

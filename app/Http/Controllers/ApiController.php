<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\JsonTrait;
use App\Models\Employee;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{

    use JsonTrait;
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * User API
     * Get all the user by pagination
     * @bodyParam page int Page number for pagination. Example: 1
     * @authenticated
     * @header Authorization Bearer {{token}}
     */
    public function users(){

        $user = User::where('id',auth()->user()->id)->first();
        $response = Gate::inspect('update', $user);

        if ($response->allowed()) {
            // The action is authorized...
            $users = User::paginate(10);
            return $this->jsonResponse(
                UserResource::collection($users)
            );
        } else {
            echo $response->message();
        }


    }

    /**
     * Dashboard
     *
     * Check that the service is up. If everything is okay, you'll get a 200 OK response.
     *
     * Otherwise, the request will fail with a 400 error, and a response listing the failed services.
     *
     * @authenticated
     * @header Authorization Bearer {{token}}
     * @response 401 scenario="invalid token"
     */
    public function dashboard(Request $request){

        $user_total = User::count();
        $code = 0;
        $employee =  Employee::whereId(1)
                    ->with(['user', 'jobHistory'])
                    ->first();

        return $this->jsonResponse(
            compact('user_total', 'code','employee'),
            '',
            200);
        // return response()->json(
        //     compact('user_total', 'code')
        // );
    }

    //
    /**
     * Login Api
     * @bodyParam email string required  Email of the user. Example: superadmin@invoke.com
     * @bodyParam password string required  Password of the user. Example: password
     * @bodyParam user_id int  The id of the user. Example: 9
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->jsonResponse(
                $validator->errors(),
                'Invalid Input Parameters',
                422);
            // response()->json($validator->errors(), 422);
        }

        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


}

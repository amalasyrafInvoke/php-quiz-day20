<?php

namespace App\Http\Controllers;

use App\Http\Traits\JsonTrait;
use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index(Request $request){

        if($request->isMethod('post')){
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                if(Auth::user()->role==1){
                    $request->session()->regenerate();
                    $jwt_token = JWTAuth::attempt($credentials);
                    session(['jwt_token' => $jwt_token]);

                    // return redirect('admin/dashboard');
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect('/');
                }
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);

        }
        return view('admin.login');
    }

    public function dasboard(){

        $jwt_token = session('jwt_token');
        $user_count = User::count();

        // return view('admin.dashboard', [
        //     'jwt_token'=>$jwt_token,
        // ]);
        return view('admin.dashboard',
         compact('jwt_token','user_count'));

    }

    public function user(){

        $users = User::paginate(10);

        return view('admin.user', compact("users"));

    }
}

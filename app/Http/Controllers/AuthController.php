<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Auth Class
 */
class AuthController extends Controller
{
    public function register(Request $request){
        
        $fields = $request->validate([
            'username'=>'required|max:255|unique:users',
            'email'=>'required|max:100|email|unique:users',
            'password'=>'required|min:6|max:16|confirmed'
        ]);

        $user = User::create($fields);
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    /**
     * Login Method
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
        if(Auth::attempt($fields,$request->remember)){
            return redirect()->intended('dashboard');
        }else{
            return back()->withErrors([
                'failed' => 'Username or password incorrect.'
            ]);
        }
    }

    /**
     * Logout method
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function authentication(Request $request){
        $this->validate($request, [
            'email' => 'required|min:3',
            'password' => 'required|min:3'
        ]); 
    
        if(Auth::attempt($request->only('email','password'))){
            if(auth()->user()->role == 'admin'){
             return redirect('admin/dashboard');
            }
            if(auth()->user()->role == 'consumer'){
                return redirect('consumer/dashboard');
            }
         }
         else {
            return redirect()->route('auth.login');
         } 
         return redirect()->route('auth.login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}

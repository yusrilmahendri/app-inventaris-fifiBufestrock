<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consumer;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function register(Request $request){

          // VALIDASI INPUTAN FORM
          $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users|required',
            'password' => 'required|min:3',
            'phone' =>  'required|min:3', 
            'alamat' => 'required|min:3',
        ]);

        // INSERT TO TABLE USER
            $user = new User;
            $user->role = 'consumer';
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = str::random(60);
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->alamat = $request->alamat;
            $user->save();
        
        // INSERT TO TABLE SUPLIER
        Consumer::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $request->password,
            'remember_token' => $user->remember_token,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'alamat' => $user->alamat,
        ]);       
        return redirect('/login')->with("success",'Selamat Akun Anda  Berhasil di Daftarkan');
    }

}

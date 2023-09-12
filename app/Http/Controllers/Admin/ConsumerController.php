<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class ConsumerController extends Controller
{
    public function index(){
        return view('admin.consumers.index', [
            'title' => 'Information Consumers'
        ]);
    }

    public function create(){
        return view('admin.consumers.create', [
            'title' => 'Daftarkan Consumer',
        ]);
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'password' => 'required|min:3',
            'phone' =>  'required|min:3', 
            'alamat' => 'required|min:3',
        ]);

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
    
        // INSERT TO TABLE KONSUMEN
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
    return redirect()->route('admin.consumers')->with("success", "Sukses di daftarkan");
    }

    public function show($id){
        $consumer = Consumer::findOrFail($id);
        return view('admin.consumers.show', [
            'title' => 'Information Detail Consumer',
            'consumer' => $consumer,
        ]);
    }

    public function destroy($id){
        $consumer = Consumer::findOrFail($id);
        $user = User::where('id', $consumer->user_id)->first();
        
        if($consumer->user_id == $user->id){
            $consumer->delete();
            $user->delete();
        }
        return redirect()->route('admin.consumers')->with('danger','Data Berhasil di hapuskan.!');
    }
}

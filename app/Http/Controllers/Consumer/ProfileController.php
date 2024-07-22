<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Traits\HasNotifications;

class ProfileController extends Controller
{
    use HasNotifications;

    public function index(){
        $data = $this->getConsumerAndProducts();
        $user = Auth()->user()->id;
        $consumer = Consumer::where('user_id',$user)->first();
        return view('consumer.profile.index', [
            'consumer' => $consumer,
            'title' => 'Informasi Saya',
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
            'leadTime' => $data['leadTime'],
            'leadTimes' => $data['leadTimes'],   
        ]);
    }

    public function update(Request $request){

        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'password' => 'required|min:3',
            'phone' =>  'required|min:3', 
            'alamat' => 'required|min:3',
        ]);
        
        $user = Auth()->user()->id;
        $users = Auth()->user();
        $consumer = Consumer::where('user_id',$user)->first();
        $consumer->update($request->all());
        $users->update([
            'name' => $consumer->name,
            'email' => $consumer->email,
            'password' => bcrypt($consumer->password),
            'phone' => $consumer->phone,
            'gender' => $consumer->gender,
            'alamat' => $consumer->alamat,
        ]);
   
        return redirect()->route('consumer.profile')->with('info','Informasi Berhasil di Update');
       
    }
}

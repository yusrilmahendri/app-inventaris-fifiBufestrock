<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadTime;
use App\ModelS\Consumer;
use App\ModelS\Product;
use App\Models\BufferStock;

class LeadTimeController extends Controller
{
    public function index(){
        return view('consumer.leadtime.index', [
           'title' => 'notifikasi barang',
        ]);
    }

    public function destroy($id){
        $leadTime = LeadTime::findOrFail($id);
        $leadTime->delete();

        return redirect()->route('consumer.leadTime')->with('danger', 'Pesan lead time berhasil dihapuskan');
    }
}

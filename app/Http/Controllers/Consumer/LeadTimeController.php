<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadTime;
use App\ModelS\Consumer;
use App\ModelS\Product;
use App\Models\BufferStock;
use App\Traits\HasNotifications;


class LeadTimeController extends Controller
{
    use HasNotifications;

    public function index(){
        $data = $this->getConsumerAndProducts();
        return view('consumer.leadtime.index', [
           'title' => 'notifikasi barang',
           'bufferStock' => $data['countBufferStock'],
           'notifications' => $data['notifications'],
        ]);
    }

    public function destroy($id){
        $leadTime = LeadTime::findOrFail($id);
        $leadTime->delete();

        return redirect()->route('consumer.leadTime')->with('danger', 'Pesan lead time berhasil dihapuskan');
    }
}

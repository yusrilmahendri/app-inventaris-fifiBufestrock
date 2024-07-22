<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Product;
use App\Models\BufferStock;
use App\Models\LeadTime;
use App\Traits\HasNotifications;


class BufferStockController extends Controller
{   
    use HasNotifications;

    public function index(){
        $data = $this->getConsumerAndProducts();
        return view('consumer.bufferStock.index', [
            'title' => 'Notifikasi Buffer Stock',
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
            'leadTime' => $data['leadTime'],     
            'leadTimes' => $data['leadTimes'],     
        ]); 
    }
}

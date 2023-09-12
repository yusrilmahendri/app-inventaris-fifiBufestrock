<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Product;
use App\Models\BufferStock;
use App\Models\LeadTime;

class BufferStockController extends Controller
{   
    public function index(){
        return view('consumer.bufferStock.index', [
            'title' => 'Notifikasi Buffer Stock',
        ]); 
    }
}

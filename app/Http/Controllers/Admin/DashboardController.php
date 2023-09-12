<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index(){
        $consumer = Consumer::all()->count();
        $supplier = Supplier::all()->count();
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'totalConsumer' => $consumer,
            'totalSupplier' => $supplier,
        ]);
    }
    
}

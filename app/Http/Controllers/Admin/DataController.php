<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Consumer;
use App\Models\Product;
use Carbon\Carbon;

class DataController extends Controller
{
    public function suppliers(){
        $supplier = Supplier::orderBy('created_at','desc');
            return datatables()->of($supplier)
            ->addColumn('action', 'admin.suppliers.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function consumers(){
        $consumers = Consumer::orderBy('created_at', 'desc');
        return datatables()->of($consumers)
            ->addColumn('action', 'admin.consumers.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}

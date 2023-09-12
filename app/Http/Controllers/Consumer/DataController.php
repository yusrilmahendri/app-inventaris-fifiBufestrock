<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use App\Models\BufferStock;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Consumer;
use App\Models\InventoryMoment;
use App\Models\LeadTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use PDF;


class DataController extends Controller
{   
    public function suppliers(){
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $supplierQuery = Supplier::where('consumer_id', $consumer->id);
        $supplier = $supplierQuery->orderBy('created_at', 'asc');
            return datatables()->of($supplier)
            ->addColumn('action', 'consumer.supplier.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function products(){
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $productsQuery = Product::where('consumer_id', $consumer->id); 
        // Query builder instance
        $products = $productsQuery->orderBy('created_at', 'asc');
        return datatables()->of($products)
            ->addColumn('created_at', function ($product) {
                return Carbon::parse($product->created_at)->format('d-m-Y');
            })
            ->addColumn('name_supplier', function(Product $model){
                return $model->supplier->name;
            })
            ->addColumn('action', 'consumer.product.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function productsIn()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $products = Product::where('consumer_id', $consumer->id)->get();
    
        $productIds = $products->pluck('id'); // Get an array of product IDs
    
        $productsIn = InventoryMoment::whereIn('product_id', $productIds)
            ->whereHas('product', function ($query) {
                $query->where('type', 'masuk');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return datatables()->of($productsIn)
            ->addColumn('created_at', function ($productsIn) {
                return Carbon::parse($productsIn->created_at)->format('d-m-Y');
            })
            ->addColumn('name_product', function ($productsIn) {
                return $productsIn->product->name;
            })
            ->addColumn('action', 'consumer.inventoryMoments.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
    

   public function productsOut()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $products = Product::where('consumer_id', $consumer->id)->get();

        $productIds = $products->pluck('id'); // Get an array of product IDs

        $productsOut = InventoryMoment::whereIn('product_id', $productIds)
            ->whereHas('product', function ($query) {
                $query->where('type', 'keluar');
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
        return datatables()->of($productsOut)
            ->addColumn('created_at', function ($productOut) {
            return Carbon::parse($productOut->created_at)->format('d-m-Y');
            })
            ->addColumn('name_product', function ($productIn) {
            return $productIn->product->name;
            })
            ->addColumn('action', 'consumer.inventoryMoments.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function bufferStock(){
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $products = Product::where('consumer_id', $consumer->id)->get();

        $productIds = $products->pluck('id'); // Get an array of product IDs

        $bufferStocks = BufferStock::whereIn('product_id', $productIds)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return datatables()->of($bufferStocks)
            ->addColumn('created_at', function ($bufferStocks) {
            return Carbon::parse($bufferStocks->created_at)->format('d-m-Y');
            })
            ->addColumn('name_product', function ($bufferProduct) {
            return $bufferProduct->product->name;
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function generatePdfProducts()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $productsQuery = Product::where('consumer_id', $consumer->id);
        $products = $productsQuery->orderBy('created_at', 'asc')->get(); // Fetch the results

    // Generate HTML for the data table
        $html = '<table style="width:100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Kode Barang</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Consumer</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Supplier</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Category</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Barang</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Harga Per-Unit</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Total Persediaan</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Tanggal Masuk</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($products as $product) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->id . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->consumer->name . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->supplier->name . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->category. '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->name . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->harga_unit . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->total_persediaan . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . Carbon::parse($product->created_at)->format('d-m-Y') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Generate PDF from the HTML
        $pdf = PDF::loadHTML($html);

        // Optional: Set PDF options
        $pdf->setOption('margin-top', 10);
        $pdf->setOption('margin-bottom', 10);

        // Return the PDF as a download
        return $pdf->download('products.pdf');
    }

    public function generatePdfProductsIn()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $products = Product::where('consumer_id', $consumer->id)->get();
    
        $productIds = $products->pluck('id'); // Get an array of product IDs
    
        $productsIn = InventoryMoment::whereIn('product_id', $productIds)
            ->whereHas('product', function ($query) {
                $query->where('type', 'masuk');
            })
            ->orderBy('created_at', 'asc')
            ->get();
    
        // Generate HTML for the data table
        $html = '<table style="width:100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Kode Barang</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Barang</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Jumlah Barang Keluar</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Tanggal Masuk</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
    
        foreach ($productsIn as $product) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->product->id . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->product->name . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->quantity. '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . Carbon::parse($product->created_at)->format('d-m-Y') . '</td>';
            $html .= '</tr>';
        }
    
        $html .= '</tbody>';
        $html .= '</table>';
    
        // Generate PDF from the HTML
        $pdf = PDF::loadHTML($html);
    
        // Optional: Set PDF options
        $pdf->setOption('margin-top', 10);
        $pdf->setOption('margin-bottom', 10);
    
        // Return the PDF as a download
        return $pdf->download('incoming_inventory.pdf');
    }
    
    public function generatePdfProductsOut()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $products = Product::where('consumer_id', $consumer->id)->get();

        $productIds = $products->pluck('id'); // Get an array of product IDs

        $productsOut = InventoryMoment::whereIn('product_id', $productIds)
            ->whereHas('product', function ($query) {
                $query->where('type', 'keluar');
            })
            ->orderBy('created_at', 'asc')
            ->get();

    // Generate HTML for the data table
    $html = '<table style="width:100%; border-collapse: collapse;">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Kode Barang</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Barang</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Jumlah Barang Keluar</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Tanggal Keluar</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    foreach ($productsOut as $product) {
        $html .= '<tr>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->product->id . '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->product->name . '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $product->quantity. '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . Carbon::parse($product->created_at)->format('d-m-Y') . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    // Generate PDF from the HTML
    $pdf = PDF::loadHTML($html);

    // Optional: Set PDF options
    $pdf->setOption('margin-top', 10);
    $pdf->setOption('margin-bottom', 10);

    // Return the PDF as a download
    return $pdf->download('outgoing_inventory.pdf');
    }

    public function leadTime(){
        $auth = Auth::user(); // Mengambil pelanggan yang sedang login
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $products = Product::where('consumer_id', $consumer->id)->get();
        $productIds = $products->pluck('id');
        $leadTimes = leadTime::whereIn('product_id', $productIds)->get();
        
        return datatables()->of($leadTimes)
            ->addColumn('name_product', function ($leadTimes) {
                return $leadTimes->product->name;
                })
            ->addColumn('action', 'consumer.leadTime.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

}

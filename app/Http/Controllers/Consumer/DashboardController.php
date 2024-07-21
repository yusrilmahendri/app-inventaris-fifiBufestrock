<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Consumer;
use App\Models\InventoryMoment;
use App\Models\BufferStock;
use App\Models\LeadTime;

class DashboardController extends Controller
{
  public function index($countProducts = 0)
  {
    $auth = Auth()->user();
    $consumer = Consumer::where('user_id', $auth->id)->first();

    $countProducts = Product::where('consumer_id', $consumer->id)->count();
    $product = Product::where('consumer_id', $consumer->id)->first();
    $products = Product::where('consumer_id', $consumer->id)->get();

    $productIds = $products->pluck('id');
    $bufferStocks = BufferStock::whereIn('product_id', $productIds)->orderBy('created_at', 'desc')->take(3)->get();

    $countProductOut = 0;
    $countProductIn = 0;
    $countBufferStock = 0;
    $countLeadTime = 0;
    foreach ($products as $product) {
        $countProductIn += InventoryMoment::where('product_id', $product->id)->where('type', 'masuk')->count();
        $countProductOut += InventoryMoment::where('product_id', $product->id)->where('type', 'keluar')->count();
        $countBufferStock += BufferStock::where('product_id', $product->id)->count();
        $countLeadTime += LeadTime::where('product_id', $product->id)->count();
      }

  return view('consumer.dashboard', [
        'products' => $countProducts,
        'productsOut' => $countProductOut,
        'productsIn' => $countProductIn,
        'bufferStock' => $countBufferStock,
        'leadTime' => $countLeadTime,
        'notifications' => $bufferStocks
    ]);
  }
}

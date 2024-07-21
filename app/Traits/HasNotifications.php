<?php


namespace App\Traits;

use App\Models\Product;
use App\Models\BufferStock;
use App\Models\Consumer;
use Illuminate\Support\Facades\Auth;

trait HasNotifications
{
    public function notifications($consumerId)
    {   
        $products = Product::where('consumer_id', $consumerId)->get();
        $countBufferStock = 0;

        foreach ($products as $product) {
            $countBufferStock += BufferStock::where('product_id', $product->id)->count();
        }

        return $countBufferStock;
    }

    public function getConsumerAndProducts()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $products = Product::where('consumer_id', $consumer->id)->get();

        $productIds = $products->pluck('id');

        $bufferStocks = BufferStock::whereIn('product_id', $productIds)->orderBy('created_at', 'desc')->take(3)->get();

        if ($consumer) {
            $products = Product::where('consumer_id', $consumer->id)->get();
            $countBufferStock = $this->notifications($consumer->id);

            return [
                'consumer' => $consumer,
                'products' => $products,
                'countBufferStock' => $countBufferStock,
                'notifications' => $bufferStocks
            ];
        }

        return null;
    }
}

<?php


namespace App\Traits;

use App\Models\Product;
use App\Models\BufferStock;
use App\Models\Consumer;
use App\Models\LeadTime;
use Illuminate\Support\Facades\Auth;

trait HasNotifications
{
    public function notifications($consumerId)
    {   
        // Mengambil semua produk dengan consumer_id yang diberikan
        $products = Product::where('consumer_id', $consumerId)->pluck('id');

        // Menghitung jumlah BufferStock untuk semua produk
        $countBufferStock = BufferStock::whereIn('product_id', $products)->count();

        // Menghitung jumlah LeadTime untuk semua produk
        $countLeadTime = LeadTime::whereIn('product_id', $products)->count();

        // Mengembalikan hasil sebagai array
        return [
            'countBufferStock' => $countBufferStock,
            'countLeadTime' => $countLeadTime,
        ];
    }

    public function getConsumerAndProducts()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();

        if ($consumer) {
            $products = Product::where('consumer_id', $consumer->id)->get();
            $productIds = $products->pluck('id');
            $bufferStocks = BufferStock::whereIn('product_id', $productIds)->orderBy('created_at', 'desc')->take(2)->get();
            $notifications = $this->notifications($consumer->id);
            $leadTimes = leadTime::whereIn('product_id', $productIds)->take(2)->get();
        

            return [
                'consumer' => $consumer,
                'products' => $products,
                'countBufferStock' => $notifications['countBufferStock'],
                'notifications' => $bufferStocks,
                'leadTime' => $notifications['countLeadTime'],
                'leadTimes' => $leadTimes,
            ];
        }

        return null;
    }
}

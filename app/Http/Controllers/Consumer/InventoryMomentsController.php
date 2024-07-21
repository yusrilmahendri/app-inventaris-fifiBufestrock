<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use App\Models\BufferStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Consumer;
use App\Models\Product;
use App\Models\InventoryMoment;
use App\Traits\HasNotifications;

class InventoryMomentsController extends Controller
{
    use HasNotifications;

    public function riwayatBarangMasuk(){
        $data = $this->getConsumerAndProducts();
        return view('consumer.inventoryMoments.barangMasuk', [
            'title' => 'Riwayat barang yang keluar',
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
        ]);
    }

    public function inventoryIn()
    {   
        $data = $this->getConsumerAndProducts();
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $product = Product::where('consumer_id', $consumer->id)->orderBy('created_at', 'desc')->get();
        
        return view('consumer.inventoryMoments.addInventory', [
            'title' => 'Barang Masuk',
            'products' =>  $product,
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
        ]);
    }

    public function addInventory(Request $request){

        $this->validate($request, [
            'quantity' => 'required|min:1',
        ]);

        $product  = Product::findOrFail(request('product_id'));

        // update quantity
        $inputQuantity = request('quantity');
        $product->total_persediaan += $inputQuantity;
        $product->save();

        InventoryMoment::create([
            'product_id' => $request->product_id,
            'quantity' => $inputQuantity,
            'type' => 'masuk',
        ]);

        // check buffer stock    
        if($this->checkBufferStock($product) < $product->safety_stock){
            $bufferStock = BufferStock::where('product_id', $product->id)->get();
            $bufferStock->each(function ($stock) {
                $stock->delete();
            });
        }

        return redirect()->route('consumer.riwayatBarangMasuk')->with('success', 'stock Barang berhasil ditambahkan.');
    }

    public function riwayatInventoryOut(){
        $data = $this->getConsumerAndProducts();
        return view('consumer.inventoryMoments.barangKeluar', [
            'title' => 'Riwayat Barang Keluar',
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
        ]);
    }

    public function inventoryOut(){
        $data = $this->getConsumerAndProducts();
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $product = Product::where('consumer_id', $consumer->id)->orderBy('created_at', 'desc')->get();
        return view('consumer.inventoryMoments.inventoryOut', [
            'title' => 'barang keluar',
            'products' =>  $product,
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
        ]);
    }

    public function removeInventory(Request $request)
    {   
        $this->validate($request, [
            'quantity' => 'required|min:1',
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        $inputQuantity = $request->input('quantity');
        
        // Ensure the requested quantity is not greater than the available quantity
        if ($inputQuantity > $product->total_persediaan) {
            return redirect()->back()->with('danger', 'Inputan anda melebihi dari stock barang.');
        }
    
        // Update quantity
        $product->total_persediaan -= $inputQuantity;
        $product->save();
    
        InventoryMoment::create([
            'product_id' => $request->product_id,
            'quantity' => $inputQuantity,
            'type' => 'keluar',
        ]);
    
        // Check buffer stock    
        $this->checkBufferStock($product);
        
        return redirect()->route('consumer.riwayatInventoryOut')->with('success', 'Barang sudah berkurang.');
    }
    

    private function checkBufferStock(Product $product)
    {   
        // safetry stock == buffer quantity
        $bufferStock = $product->safety_stock;
        if ($bufferStock && $product->total_persediaan <= $bufferStock) {
           BufferStock::create([
                'product_id' => $product->id,
                'reason' => 'Ups, Stock barang anda telah melebihi dari safety stock, silahkan update stock barang anda, Terimakasih.',
           ]);
        return redirect()->route('consumer.bufferStock')->with('dangers','Silahkan update jumlah barang product anda');
        }
        $rop = $product->rop;
        if ($rop && $product->total_persediaan <= $rop) {
           BufferStock::create([
                'product_id' => $product->id,
                'reason' => 'Ups, Stock barang anda telah mendekati dari Reorder Point (ROP), silahkan update jumlah barang product anda, Terimakasih.',
           ]);
        return redirect()->route('consumer.bufferStock')->with('dangers','Silahkan update jumlah barang product anda');
        }
    }
    
    public function destroyProductIn($id){
        $productIn = InventoryMoment::findOrFail($id);
        $productIn->delete();
        return redirect()->back()->with('danger', 'Riwayat berhasil di hapuskan');
    }

}

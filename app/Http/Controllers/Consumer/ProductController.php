<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Consumer;
use Illuminate\Support\Facades\Auth;
use App\Models\BufferStock;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        return view('consumer.product.index', [
            'title' => 'Koleksi Item Products',
        ]);
    }

    public function create()
    {
        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $suppliers = [];

        if ($consumer) {
            $suppliers = Supplier::where('consumer_id', $consumer->id)->orderBy('name', 'ASC')->get();
        }

        return view('consumer.product.create', [
            'title' => 'Daftarkan Produk',
            'suppliers' => $suppliers,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|min:2|unique:products',
            'category' => 'required|min:3',
            'name' => 'required|min:3',
            'harga_unit' => 'required',
            'total_persediaan' => 'required',
            'safety_stock' => 'required',
            'lead_time' => 'required',
        ]);

        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        $consumer_id = $consumer->id;

        if ($consumer) {
            // Check safety stock and total persediaan
            if ($request->safety_stock >= $request->total_persediaan) {
                return redirect()->back()->with('danger', 'Safety stock harus lebih kecil dari total persediaan.');
            }

            $product = new Product;
            $product->id = $request->id;
            $product->consumer_id = $consumer_id;
            $product->supplier_id = $request->supplier_id;
            $product->category = $request->category;
            $product->name = $request->name;
            $product->harga_unit = $request->harga_unit;
            $product->total_persediaan = $request->total_persediaan;
            $product->safety_stock = $request->safety_stock;
            $product->lead_time = $request->lead_time;
            $product->save();

            return redirect()->route('consumer.products')->with('success', 'Product berhasil didaftarkan');

        } else {
            return redirect()->back()->with('danger', 'Safety stock harus lebih kecil dari total persediaan.');
        }
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('consumer.product.show', [
            'title' => 'Detail item product',
            'product' => $product
        ]);
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'harga_unit' => 'required',
            'lead_time' => 'required',
            'safety_stock' => 'required'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'harga_unit' => $request->harga_unit,
            'lead_time' => $request->lead_time,
            'safety_stock' => $request->safety_stock,
        ]);

         // Check buffer stock
         $this->checkBufferStock($product);
        return redirect()->route('consumer.products')->with('info','Data Barang Berhasil di Ubah');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->inventoryMoment()->delete();
        $product->bufferStock()->delete();
        $product->delete();

        return redirect()->route('consumer.products')->with('danger', 'Data Berhasil Di Hapuskan');
    }


    private function checkBufferStock(Product $product)
    {
        // safetry stock == buffer quantity
        $bufferStock = $product->safety_stock;
        if ($bufferStock && $product->total_persediaan <= $bufferStock) {
           BufferStock::create([
                'product_id' => $product->id,
                'reason' => 'Ups, Stock barang anda telah mendekati dari safety stock, silahkan update stock barang anda, Terimakasih.',
           ]);
        return redirect()->route('consumer.bufferStock')->with('dangers','Silahkan update jumlah barang product anda');
        }
    }

}

<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Consumer;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use App\Traits\HasNotifications;

class SupplierController extends Controller
{   
    use HasNotifications;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->getConsumerAndProducts();

        return view('consumer.supplier.index', [
            'title' => 'Informasi Supplier',
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
      $data = $this->getConsumerAndProducts();
      return view('consumer.supplier.create', [
        'bufferStock' => $data['countBufferStock'],
        'notifications' => $data['notifications'],
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|unique:suppliers', // Make email field nullable, allowing it to be empty
            'phone' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
        ]);

        $auth = Auth::user();
        $consumer = Consumer::where('user_id', $auth->id)->first();
        if ($consumer) {
            $data = [
                'consumer_id' => $consumer->id,
                'supplier_id' => $request->supplier_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
            ];

            // Check if the email field is not empty before adding it to the data array
            if ($request->filled('email')) {
                $data['email'] = $request->email;
            }
            Supplier::create($data);

            return redirect()->route('consumer.create.product')->with('success', 'Supplier berhasil di daftarkan');
        }

        return redirect()->back()->with('danger', 'Maaf data supplier gagal di daftarkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id = null)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id = null)
    {   
        $data = $this->getConsumerAndProducts();
        $supplier = Supplier::findOrFail($id);
        $product = Product::where('supplier_id', $supplier->id)->get();
        $uniqueCategories = array_values(array_unique(array_map('strtolower', $product->pluck('category')->toArray())));
        return view('consumer.supplier.edit', [
            'supplier' => $supplier,
            'products' => $product,
            'id' => $id,
            'uniqueCategories' => $uniqueCategories,
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'alamat' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('consumer.supplier.index')->with('success', 'Supplier berhasil di daftarkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->back()->with('danger', 'Data Supplier Berhasil');
    }

    public function category(string $id, string $category = null)
    {   
        $data = $this->getConsumerAndProducts();
        $supplier = Supplier::findOrFail($id);
        $products = Product::where('supplier_id', $supplier->id)->get();

        // Collect all the categories from the products
        $allCategories = $products->pluck('category')->toArray();

        // Get unique categories by making them lowercase to handle case-insensitivity
        $uniqueCategories = array_values(array_unique(array_map('strtolower', $allCategories)));

        // Create an associative array to hold products by category
        $productsByCategory = [];

        // Loop through products and categorize them based on their categories
        foreach ($products as $product) {
            $category = strtolower($product->category);

            // If the category is already added, merge the products into the existing category
            if (isset($productsByCategory[$category])) {
                $productsByCategory[$category]['products'][] = $product;
            } else {
                $productsByCategory[$category] = [
                    'name' => $product->category,
                    'products' => [$product],
                ];
         }
    }

        return view('consumer.category.show', [
            'supplier' => $supplier,
            'productsByCategory' => $productsByCategory,
            'id' => $id,
            'uniqueCategories' => $uniqueCategories,
            'bufferStock' => $data['countBufferStock'],
            'notifications' => $data['notifications'],
        ]);
    }

}

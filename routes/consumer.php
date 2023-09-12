<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Consumer\DashboardController;
use App\Http\Controllers\Consumer\ProfileController;
use App\Http\Controllers\Consumer\ProductController;
use App\Http\Controllers\Consumer\DataController;
use App\Http\Controllers\Consumer\InventoryMomentsController;
use App\Http\Controllers\Consumer\BufferStockController;
use App\Http\Controllers\Consumer\LeadTimeController;
use App\Http\Controllers\Consumer\SupplierController;

/*
|--------------------------------------------------------------------------
| consumer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DataController::class)->group(function(){
    Route::get('/suppliers/api', 'suppliers')->name('api.suppliers');
    Route::get('/product/api', 'products')->name('api.product');
    Route::get('/productsIn/api', 'productsIn')->name('api.productsIn');
    Route::get('/productOut/api', 'productsOut')->name('api.productOut');
    Route::get('/bufferStock/api', 'bufferStock')->name('api.bufferStock');
    Route::get('/leadTime/api','leadTime')->name('api.leadTime');
    Route::get('/generatePdfProducts', 'generatePdfProducts')->name('generatePdfProducts');
    Route::get('/generatePdfProductsIn', 'generatePdfProductsIn')->name('generatePdfProductsIn');
    Route::get('/generatePdfProductsOut','generatePdfProductsOut')->name('generatePdfProductsOut');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(ProfileController::class)->group(function(){
    Route::get('/profile', 'index')->name('profile');
    Route::put('/profile/{id}', 'update')->name('update');
});

Route::resource('supplier', SupplierController::class);
Route::get('products/{id}/{category?}', [SupplierController::class, 'category'])->name('category');

Route::controller(ProductController::class)->group(function(){
    Route::get('/products', 'index')->name('products');
    Route::get('create/product', 'create')->name('create.product');
    Route::post('create/product', 'store')->name('store.product');
    Route::get('/product/{id}/detail', 'show')->name('product.show');
    Route::put('/product/{id}/update', 'update')->name('product.update');
    Route::delete('/category/{id}', 'destroy')->name('product.destroy');
});

Route::controller(InventoryMomentsController::class)->group(function(){
    Route::get('/riwayat/productIn', 'riwayatBarangMasuk')->name('riwayatBarangMasuk');
    Route::get('/riwayat/productOut', 'riwayatInventoryOut')->name('riwayatInventoryOut');
    Route::get('/addInventory', 'inventoryIn')->name('add.inventory');
    Route::get('/inventoryOut', 'inventoryOut')->name('inventoryOut');
    Route::post('/addInventory/create', 'addInventory')->name('addInventory.store');
    Route::post('/inventoryOut/create', 'removeInventory')->name('removeInventory.store');
    Route::delete('/destroyProductIn/{id}', 'destroyProductIn')->name('destroyProductIn');
});

Route::controller(BufferStockController::class)->group(function(){
    Route::get('/bufferStock', 'index')->name('bufferStock');
});

Route::controller(LeadTimeController::class)->group(function(){
    Route::get('/leadTimes', 'index')->name('leadTime');
    Route::delete('/leadTime/{id}', 'destroy')->name('leadTime.destroy');
});



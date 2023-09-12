<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\ConsumerController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::get('/api/consumer', [DataController::class, 'consumers'])->name('api.consumer');
Route::controller(ConsumerController::class)->group(function() {
    Route::get('/consumers', 'index')->name('consumers');
    Route::get('/consumer/detail/{id}', 'show')->name('show.consumer');
    Route::delete('/consumer/{id}', 'destroy')->name('consumer.destroy');
});
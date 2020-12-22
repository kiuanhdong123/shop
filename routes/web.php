<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/Brand', [HomeController::class, 'brand']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/login', [HomeController::class, 'indexlogin']);
Route::get('/register', [HomeController::class, 'indexregister']);
Route::get('/detail', [HomeController::class, 'detail']);
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/updateCart', [HomeController::class, 'updateCart']);

Route::post('/logincontroller', [HomeController::class, 'logincontroller']);
Route::post('/registercontroller', [HomeController::class, 'registercontroller']);


Route::get('/session', function (Request $requets) {
    $request->session()->put('name', 'Le Quang Tuan');
});
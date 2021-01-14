<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


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
Route::get('/detail', [HomeController::class, 'detail']);
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/updateCart', [HomeController::class, 'updateCart']);

Route::get('/login', [UserController::class, 'indexlogin']);
Route::get('/register', [UserController::class, 'indexregister']);
Route::get('/user', [UserController::class, 'indexUser'])->name('user');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/Add', [ProductController::class, 'Add'])->name('Add');
Route::get('/loadAdd', [ProductController::class, 'loadAdd'])->name('loadAdd');
Route::get('/Update', [ProductController::class, 'Update'])->name('Update');
Route::get('/loadUpdate', [ProductController::class, 'loadUpdate'])->name('loadUpdate');

Route::get('/updateCategory', [HomeController::class, 'updateCategory'])->name('updateCategory');

Route::post('/logincontroller', [UserController::class, 'logincontroller']);
Route::post('/registercontroller', [UserController::class, 'registercontroller']);
Route::post('/userController', [UserController::class, 'userController']);
Route::post('/updateCategory', [HomeController::class, 'updateCategory']);



// Route::get('/test', function (Request $requets) {
//     return 'test';
// })->name('test');


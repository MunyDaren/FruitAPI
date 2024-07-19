<?php

use App\Http\Controllers\AddToCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ============================================
Route::get('categories', [CategoryController::class, 'index']);       // Get all categories
Route::post('categories', [CategoryController::class, 'store']);      // Create a new category
Route::get('categories/{category}', [CategoryController::class, 'show']); // Get a specific category
Route::put('categories/{category}', [CategoryController::class, 'update']); // Update a specific category
Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

//=============================================
Route::get('products', [ProductController::class, 'index']);           // Get all products
Route::post('products', [ProductController::class, 'store']);          // Create a new product
Route::get('products/{product}', [ProductController::class, 'show']);  // Get a specific product
Route::put('products/{product}', [ProductController::class, 'update']); // Update a specific product
Route::delete('products/{product}', [ProductController::class, 'destroy']);


Route::post('/add-to-cart', [AddToCartController::class, 'addToCart']);
Route::delete('/remove-from-cart/{id}', [AddToCartController::class, 'removeFromCart']);
Route::get('/cart', [AddToCartController::class, 'getCart']);
Route::delete('/clear-cart', [AddToCartController::class, 'clearCart']);
Route::put('/update-cart/{id}', [AddToCartController::class, 'updateQuantity']);
Route::post('/confirm-order', [PurchaseController::class, 'confirmOrder']);
// Route::get('/purchases', [PurchaseController::class, 'getAllPurchases']);

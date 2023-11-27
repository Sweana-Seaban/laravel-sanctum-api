<?php

use App\Models\Product;
use App\http\Controllers\ProductController;
use App\http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//added code
// Route::get('/products',function(){
//     return Product::all();
// });
// Route::get('/products',[ProductController::class,'index']);

// // Route::post('/products',function(){
// //     return Product::create([
// //         'name'=>'Product One',
// //         'slug'=>'product-one',
// //         'description'=>'this is product one',
// //         'price'=>'100.15'
// //     ]);
// // });

// Route::post('/products',[ProductController::class,'store']);

//added code

//Route::resource('products',ProductController::class);

//public routes
Route::get('/products/search/{name}',[ProductController::class,'search']);
Route::get('/products',[ProductController::class,'index']);
Route::get('/products/search/{id}',[ProductController::class,'show']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
//protected routes

Route::group(['middleware'=>['auth:sanctum']], function () {
    //Route::get('/products/search/{name}',[ProductController::class,'search']);

    //only authenticated users should be able to send post request and store data
    Route::post('/products',[ProductController::class,'store']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);
});
//added code

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', function () {
    $products = App\Product::all();
    return view('ajax.index')->with('products',$products);
})->name('ajax.index');
Route::get('products/{product_id?}',function($product_id){
    $product = App\Product::find($product_id);
    return response()->json($product);
});
Route::post('products',function(Request $request){
    $product = App\Product::create($request->input());
    return response()->json($product);
});
Route::put('products/{product_id?}',function(Request $request,$product_id){
    $product = App\Product::find($product_id);
    $product->name = $request->name;
    $product->details = $request->details;
    $product->save();
    return response()->json($product);
});
Route::delete('products/{product_id?}',function($product_id){
    $product = App\Product::destroy($product_id);
    return response()->json($product);
});
Auth::routes();

Route::get('/home', 'HomeController@index');

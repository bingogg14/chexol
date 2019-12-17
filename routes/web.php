<?php

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

Route::get('/admin/api/v0/{path}', function () {
    return view('index');
})->where('path', '(.*)');

Route::get('/landings/military/{slug}', 'Landings\LandingProductController@index');

Route::get('/landings/military/{slug}/call', 'Order\OrderController@error');
Route::post('/landings/military/{slug}/call', 'Order\OrderController@createlo');
Route::post('/landings/military/{slug}/upsale', 'Order\OrderController@upsale');
Route::post('/landings/military/{slug}/notupsale', 'Order\OrderController@notupsale');

Route::get('example',function() {
    Artisan::call('storage:link');
    echo "Not more blank line\n";
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

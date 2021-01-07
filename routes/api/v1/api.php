<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users
Route::prefix('/user')->group( function() {
    Route::post('/login', 'api\v1\LoginController@login');
    Route::post('/register', 'api\v1\LoginController@register');
    
});

Route::prefix('/rental')->group( function() {
    Route::middleware('auth:api')->post('/create', 'api\v1\RentalsController@create');
    Route::middleware('auth:api')->get('/getrentals', 'api\v1\RentalsController@getRentals');
    Route::middleware('auth:api')->delete('/return', 'api\v1\RentalsController@return');
    
    
});

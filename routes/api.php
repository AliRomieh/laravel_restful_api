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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    //Defining A NameSpace For The Api Routes

Route::namespace('App\Http\Controllers')->group(function(){
 

//Get All Tickets Or Any Specific Ticket By Passing The Id{{Optional}}

Route::get('ticket/{id?}','Api2Controller@GetTickets');

//Add Multiple Tickets
Route::post('AddTiket','Api2Controller@AddMultiple');

//Update Any Users's Username

Route::patch('UpdateUsername/{id}','Api2Controller@UpdateUser');

//Fetching the Highest Top 3 Records According To The Maximun Value Of The Winning Amount

Route::get('sorted','Api2Controller@GetOrdered');


});

 

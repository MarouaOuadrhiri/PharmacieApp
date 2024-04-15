<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get("/test",function(){
    $name="Mazine";
    $list=["html","css","js","php"];
    return view("test",["nm"=>$name],["lst"=>$list]);
});

Route::get("/book", [Controller::class,'myBooking']);


Route::get('/',function(){
    Mail::to('ouadrhirimaroua@gmail.com')
    ->send(new App\Mail\PharmeEasy());
});
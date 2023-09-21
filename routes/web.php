<?php

use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index']);

Route::get('/login', function () {
    return view('login');
});
Route::get('/contacto', function () {
    return view('front.contacto');
});
Route::get('/post/{id}', function ($id) {
    return view('front.post')
    ->with('id',$id);
});

Route::group(['prefix'=>'/admin','alias'=>'admin'],function(){
    Route::get('/',function (){
        return view('admin.admin');
    });
    Route::get('/users',[UsersController::class,'index']);
    Route::post('/users',[UsersController::class,'store']);
});
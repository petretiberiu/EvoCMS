<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin-auth')->group(function (){
    Route::resource('/articol', 'ArticolController');
    Route::get('/articol/{articol}/delete', 'ArticolController@destroy')->name('articol.destroy');
});

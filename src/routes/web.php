<?php

/*Route::group(['namespace']);*/

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Laravelpkg\Laravelchk\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get('dmvf', 'LaravelchkController@dmvf')->name('dmvf');
});

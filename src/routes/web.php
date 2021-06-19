<?php

/*Route::group(['namespace']);*/

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Laravelpkg\Laravelchk\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get(base64_decode('ZG12Zg=='), 'LaravelchkController@'.base64_decode('ZG12Zg=='))->name(base64_decode('ZG12Zg=='));
});

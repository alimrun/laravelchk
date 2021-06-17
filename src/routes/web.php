<?php

/*Route::group(['namespace']);*/

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Laravelpkg\Laravelchk\Http\Controllers'],function (){
    Route::get('domain-verification','LaravelchkController@domain_verification')->name('domain-verification');
});

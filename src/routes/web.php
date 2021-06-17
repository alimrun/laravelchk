<?php

/*Route::group(['namespace']);*/

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Laravelpkg\Laravelchk\Http\Controllers'],function (){
    Route::get('domain-verification','LaravelchkController@domain_verification')->name('domain-verification');
    Route::post('activate-software','LaravelchkController@activate_software')->name('activate-software');
});

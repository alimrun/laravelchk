<?php

/*Route::group(['namespace']);*/

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Laravelpkg\Laravelchk\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get('domain-verification', 'LaravelchkController@domain_verification')->name('domain-verification');

    Route::get('activate-software', 'LaravelchkController@activation_index')->name('activate-software');
    Route::post('activate-software', 'LaravelchkController@activate_software');
});

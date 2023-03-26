<?php

Route::middleware(['web', 'api'])->prefix('api')->group(function () {


    Route::get('/address', 'Api\Generated\Http\Controllers\AddressApiController@index')
         ->name('list.address.api');

    Route::get('/address/show/{id}','Api\Generated\Http\Controllers\AddressApiController@show')
         ->name('show.address.api');

    Route::post('/address', 'Api\Generated\Http\Controllers\AddressApiController@store')
         ->name('store.address.api');

    Route::put('/address/{id}', 'Api\Generated\Http\Controllers\AddressApiController@update')
         ->name('update.address.api');

    Route::delete('/address/{id}','Api\Generated\Http\Controllers\AddressApiController@destroy')
         ->name('destroy.address.api');
});

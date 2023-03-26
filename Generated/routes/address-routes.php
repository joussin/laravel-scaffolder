<?php

Route::middleware(['web'])->prefix('')->group(function () {

    Route::get('/address', 'Api\Generated\Http\Controllers\AddressController@index')
         ->name('list.address.front');

    Route::get('/address/create','Api\Generated\Http\Controllers\AddressController@create')
         ->name('create.address.front');

    Route::get('/address/show/{id}','Api\Generated\Http\Controllers\AddressController@show')
         ->name('show.address.front');

    Route::get('/address/{id}/edit','Api\Generated\Http\Controllers\AddressController@edit')
         ->name('edit.address.front');

    Route::post('/address', 'Api\Generated\Http\Controllers\AddressController@store')
         ->name('store.address.front');

    Route::put('/address/{id}', 'Api\Generated\Http\Controllers\AddressController@update')
         ->name('update.address.front');

    Route::delete('/address/{id}','Api\Generated\Http\Controllers\AddressController@destroy')
         ->name('destroy.address.front');
});

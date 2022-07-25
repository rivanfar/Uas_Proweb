<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Data Satu
    Route::apiResource('data-satus', 'DataSatuApiController');

    // Data Dua
    Route::apiResource('data-duas', 'DataDuaApiController');

    // Data Tiga
    Route::apiResource('data-tigas', 'DataTigaApiController');

    // Data Empat
    Route::apiResource('data-empats', 'DataEmpatApiController');

    // Input Data
    Route::apiResource('input-datas', 'InputDataApiController');
});

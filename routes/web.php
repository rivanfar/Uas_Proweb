<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Data Satu
    Route::delete('data-satus/destroy', 'DataSatuController@massDestroy')->name('data-satus.massDestroy');
    Route::post('data-satus/parse-csv-import', 'DataSatuController@parseCsvImport')->name('data-satus.parseCsvImport');
    Route::post('data-satus/process-csv-import', 'DataSatuController@processCsvImport')->name('data-satus.processCsvImport');
    Route::resource('data-satus', 'DataSatuController');

    // Data Dua
    Route::delete('data-duas/destroy', 'DataDuaController@massDestroy')->name('data-duas.massDestroy');
    Route::post('data-duas/parse-csv-import', 'DataDuaController@parseCsvImport')->name('data-duas.parseCsvImport');
    Route::post('data-duas/process-csv-import', 'DataDuaController@processCsvImport')->name('data-duas.processCsvImport');
    Route::resource('data-duas', 'DataDuaController');

    // Data Tiga
    Route::delete('data-tigas/destroy', 'DataTigaController@massDestroy')->name('data-tigas.massDestroy');
    Route::post('data-tigas/parse-csv-import', 'DataTigaController@parseCsvImport')->name('data-tigas.parseCsvImport');
    Route::post('data-tigas/process-csv-import', 'DataTigaController@processCsvImport')->name('data-tigas.processCsvImport');
    Route::resource('data-tigas', 'DataTigaController');

    // Data Empat
    Route::delete('data-empats/destroy', 'DataEmpatController@massDestroy')->name('data-empats.massDestroy');
    Route::post('data-empats/parse-csv-import', 'DataEmpatController@parseCsvImport')->name('data-empats.parseCsvImport');
    Route::post('data-empats/process-csv-import', 'DataEmpatController@processCsvImport')->name('data-empats.processCsvImport');
    Route::resource('data-empats', 'DataEmpatController');

    // Input Data
    Route::delete('input-datas/destroy', 'InputDataController@massDestroy')->name('input-datas.massDestroy');
    Route::post('input-datas/parse-csv-import', 'InputDataController@parseCsvImport')->name('input-datas.parseCsvImport');
    Route::post('input-datas/process-csv-import', 'InputDataController@processCsvImport')->name('input-datas.processCsvImport');
    Route::resource('input-datas', 'InputDataController');

    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

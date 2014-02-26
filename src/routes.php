<?php


//Route::group(array('before' => 'auth'), function()
//{
    Route::controller('admin', '\Nifus\AdminPanel\Admin');

    Route::group(array('prefix' => 'admin'), function()
    {
        Route::controller('table', '\Nifus\AdminPanel\Admin');
    });
   // Route::resource('/admin/{module}', '\Nifus\AdminPanel\Module');
//});
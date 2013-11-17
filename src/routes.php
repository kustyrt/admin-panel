<?php


//Route::group(array('before' => 'auth'), function()
//{
    Route::get('/admin', '\Nifus\AdminPanel\Homepage@Index');
    Route::resource('/admin/{module}', '\Nifus\AdminPanel\Module');
//});
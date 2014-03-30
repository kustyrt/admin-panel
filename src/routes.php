<?php


//Route::group(array('before' => 'auth'), function()
//{
    Route::get('/admin', '\Nifus\AdminPanel\Homepage@Index');
    Route::get('/admin/json/{module}/{action}', ['uses'=>'\Nifus\AdminPanel\Main@Json','as'=>'ap.json'])->where('module','[A-Za-z\/_0-9]+');

    Route::get('/admin/{module}', '\Nifus\AdminPanel\Main@Listing')->where('module','[A-Za-z\/_0-9]+');
//});
<?php


//Route::group(array('before' => 'auth'), function()
//{
    Route::get('/admin', ['uses'=>'\Nifus\AdminPanel\Homepage@Index','as'=>'ap.main']);
    Route::get('/admin/json/{module}/{action}', ['uses'=>'\Nifus\AdminPanel\Main@Json','as'=>'ap.json'])->where('module','[A-Za-z\/_0-9]+');

    Route::get('/admin/{module}', ['uses'=>'\Nifus\AdminPanel\Main@Listing','as'=>'ap.listing'])->where('module','[A-Za-z\/_0-9]+');
//});


View::composer('admin-panel::views.layout.Index', function($view)
{
    $par = \Route::getCurrentRoute()->getParameter('module');


    $config = require app_path().'/config/packages/nifus/admin-panel/structure.php';
    $structure = $config();
    $structure->activeMenuItem($par);



    $menu  = \View::make('admin-panel::views.layout.inc.menu')->with('menu',$structure->getMenu());
    $view->with('menu_left', $menu);
});
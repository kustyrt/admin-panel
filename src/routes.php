<?php

Route::any('/admin/login', ['uses'=>'\Nifus\AdminPanel\User@Login','as'=>'ap.login']);
Route::any('/admin/logout', ['uses'=>'\Nifus\AdminPanel\User@Logout','as'=>'ap.logout']);

Route::group(array('before' => 'ap.auth'), function()
{
    Route::get('/admin', ['uses'=>'\Nifus\AdminPanel\Main@Homepage','as'=>'ap.main']);
    Route::get('/admin/json/{module}/{action}', ['uses'=>'\Nifus\AdminPanel\Main@Json','as'=>'ap.json'])->where('module','[A-Za-z\/_0-9]+');

    Route::get('/admin/{module}', ['uses'=>'\Nifus\AdminPanel\Main@Listing','as'=>'ap.listing'])->where('module','[A-Za-z\/_0-9]+');
});


/**
 *  left menu
 */
View::composer('admin-panel::views.layout.Index', function($view)
{
    $par = \Route::getCurrentRoute()->getParameter('module');
    $structure = \Nifus\AdminPanel\Helper::Config();
    $structure->activeMenuItem($par);
    $menu  = \View::make('admin-panel::views.layout.inc.menu')->with('menu',$structure->getMenu());
    $view->with('menu_left', $menu);
});


/**
 * user menu
 */
View::composer('admin-panel::views.layout.Index', function($view)
{
    $user = \Sentry::getUser();
    $menu  = \View::make('admin-panel::views.layout.inc.user')->with('user',$user);
    $view->with('user_menu', $menu);
});
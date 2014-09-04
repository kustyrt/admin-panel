<?php

Route::any('/admin/login', ['uses'=>'\Nifus\AdminPanel\User@Login','as'=>'ap.login']);
Route::any('/admin/logout', ['uses'=>'\Nifus\AdminPanel\User@Logout','as'=>'ap.logout']);

Route::group(array('before' => 'ap.auth'), function()
{
    Route::get('/admin', ['uses'=>'\Nifus\AdminPanel\Main@Homepage','as'=>'ap.main']);
    Route::get('/admin/json/{module}/{action}', ['uses'=>'\Nifus\AdminPanel\Main@Json','as'=>'ap.json'])->where('module','[A-Za-z\/_0-9]+');
    Route::get('/admin/exel/{module}/{action}', ['uses'=>'\Nifus\AdminPanel\Main@Exel','as'=>'ap.exel'])->where('module','[A-Za-z\/_0-9]+');
    Route::any('/admin/page/{module}', ['uses'=>'\Nifus\AdminPanel\Main@Page','as'=>'ap.page'])->where('module','[A-Za-z\/_0-9]+');
    Route::any('/admin/simple_page/{module}', ['uses'=>'\Nifus\AdminPanel\Main@SimplePage','as'=>'ap.simple_page'])->where('module','[A-Za-z\/_0-9]+');
    Route::any('/admin/edit/{module}', ['uses'=>'\Nifus\AdminPanel\Edit@Form','as'=>'ap.json.edit_url'])->where('module','[A-Za-z\/_0-9]+');
    Route::any('/admin/delete/{module}', ['uses'=>'\Nifus\AdminPanel\Edit@Delete','as'=>'ap.json.delete_url'])->where('module','[A-Za-z\/_0-9]+');
    Route::get('/admin/{module}', ['uses'=>'\Nifus\AdminPanel\Main@Listing','as'=>'ap.listing'])->where('module','[A-Za-z\/_0-9]+');
});

View::composer('admin-panel::views.layout.Index', function($view)
{
    $par = \Route::getCurrentRoute()->getParameter('module');
    $structure = \Nifus\AdminPanel\Helper::loadConfig('structure');
    $view->with('builder', $structure);
});

/**
 *  left menu
 */
View::composer('admin-panel::views.layout.Index', function($view)
{
    $par = \Route::getCurrentRoute()->getParameter('module');
    $structure = \Nifus\AdminPanel\Helper::loadConfig('structure');
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


View::composer('admin-panel::views.layout.Index', function($view)
{
    $structure = \Nifus\AdminPanel\Helper::loadConfig('structure');
    $files = $structure->config('js');
    $html = '';
    if ( is_array($files) ){
        foreach( $files as $file ){
            $html.=\HTML::script($file);
        }
    }
    $view->with('js', $html);


    $files = $structure->config('css');
    $html = '';
    if ( is_array($files) ){
        foreach( $files as $file ){
            $html.=\HTML::style($file);
        }
    }
    $view->with('css', $html);
});
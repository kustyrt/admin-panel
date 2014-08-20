<?php



Route::filter('ap.auth', function() {

    $structure = \Nifus\AdminPanel\Helper::loadConfig('structure');
    if ( false===$structure ){
        \App::abort(404,'Не найден конфиг для административной панели');
    }
    $auth_config = $structure->config('access');
    if ( true===$auth_config['access'] ){
        $user = Sentry::getUser();
        if ( is_null($user) ){
            if ( Request::ajax())
            {
                return \Response::json( ['redirect'=>route('ap.login')] );
            }else{
                return Redirect::route('ap.login');
            }

        }

        if ( !$user->inGroup( Sentry::findGroupById($auth_config['group'])) ){
            if ( Request::ajax())
            {
                return \Response::json( ['redirect'=>route('ap.login')] );
            }else{
                return Redirect::route('ap.login');
            }
        }
    }

});
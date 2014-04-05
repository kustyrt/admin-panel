<?php



Route::filter('ap.auth', function() {
    $structure = \Nifus\AdminPanel\Helper::Config();
    $auth_config = $structure->config('access');

    if ( true===$auth_config['access'] ){
        $user = Sentry::getUser();


        if ( is_null($user) ){
            return Redirect::route('ap.login');
        }

        if ( !$user->inGroup( Sentry::findGroupById($auth_config['group'])) ){
            return Redirect::route('ap.login');
        }

    }

});
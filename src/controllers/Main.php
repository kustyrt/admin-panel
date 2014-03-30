<?php
Namespace Nifus\AdminPanel;

Class Main extends \Controller
{

    protected $layout = 'admin-panel::views/layout/main';

    function Homepage(){
        return \View::make('admin-panel::views/homepage/Index');
    }


    function Listing($module){
          //dd(app_path().'/config/packages/nifus/admin-panel/classes/'.$module.'.php');
        if ( !file_exists(app_path().'/config/packages/nifus/admin-panel/classes/'.$module.'.php') ){
            \App::abort(404);
        }
        $closure = require app_path().'/config/packages/nifus/admin-panel/classes/'.$module.'.php';
        $result = $closure();
        dd($result);
    }

    function Edit(){

    }

}
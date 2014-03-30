<?php
Namespace Nifus\AdminPanel;


Class Main extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.Index';

    function Homepage(){
        return \View::make('admin-panel::views/homepage/Index');
    }

    function Json($module,$action){
        $builder = Builder\Listing::create($module);
        if ( false===$builder ){
            \App::abort(404);
        }
        return \Response::json( $builder->getJsonData($action) );
    }

    function Listing($module){
        $builder = Builder\Listing::create($module);
        if ( false===$builder ){
            \App::abort(404);
        }
        $this->layout->content =  $builder->execute();
    }

    function Edit(){

    }

}
<?php
Namespace Nifus\AdminPanel;


Class Main extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.Index';

    function Homepage(){
        $this->layout->content = \View::make('admin-panel::views/Main/Homepage');
    }

    function Json($module,$action){
        $builder = Builder\Listing::create($module);
        if ( false===$builder ){
            \App::abort(404);
        }
        $response = [
            'page'=> (\Input::has('page') ? \Input::get('page') : 1),
            'rows'=> $builder->getData($action),
            'total'=> $builder->getTotal(),
            'records'=> $builder->getRowNum()
        ];


        return \Response::json($response);
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
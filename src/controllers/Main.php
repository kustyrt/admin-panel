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
        $builder->setPage( \Input::get('page') );
        $builder->setOnPage( \Input::get('rows') );

        if ( \Input::has('filter') ){
            $builder->setFilter( \Input::get('filter') );
        }


        if ( false===$builder ){
            \App::abort(404);
        }

        $response = [
            'page'=> (\Input::has('page') ? \Input::get('page') : 1),
            'rows'=> $builder->getData($action),
            'records'=> $builder->getRowNum(),
            'total'=> ceil($builder->getTotal()/$builder->getRowNum() )
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

    function Page($module){
        $builder = Builder\Listing::create($module);
        //,$action,$id
        \Log::info($builder->config());
    }

}
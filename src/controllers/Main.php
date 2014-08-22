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
        $builder->setOrder( \Input::get('sidx'),\Input::get('sord') );
        if ( \Input::has('filter') ){
            $builder->setFilter( \Input::get('filter') );
        }


        if ( false===$builder ){
            \App::abort(404);
        }

        $total = ($builder->getTotal()==0) ? 0 : ceil($builder->getTotal()/$builder->getRowNum() );
        $response = [
            'page'=> (\Input::has('page') ? \Input::get('page') : 1),
            'rows'=> $builder->getData($action),
            'records'=> $builder->getRowNum(),
            'total'=> $total
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
        $config = $builder->getField(\Input::get('name'));
        if ( false!==$config && isset($config['page']) ){
            $content = $config['page']['url'](\Input::get('id'),\Input::get('name'),$module);
            return \Response::json(
                [
                    'content'=>$content,
                ]
            );
        }

        return \Response::json(
            [
                'error'=>'Not found'
            ]
        );
    }

    function SimplePage($module){
        $builder = Builder\Listing::create($module);
        $config = $builder->getButton(\Input::get('name'));
        if ( false!==$config && isset($config['method']) ){

            $content = $config['method'](\Input::get('name'),$module);
            return \Response::json(
                [
                    'content'=>$content,
                ]
            );
        }

        return \Response::json(
            [
                'error'=>'Not found'
            ]
        );
    }

}
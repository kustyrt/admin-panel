<?php
Namespace Nifus\AdminPanel;


Class CMain extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.Index';

    function Homepage(){
        $this->layout->content = \View::make('admin-panel::views/Main/Homepage');
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
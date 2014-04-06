<?php
Namespace Nifus\AdminPanel;


Class Edit extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.Index';

    function Form($module){
        $id = \Input::has('id') ? \Input::get('id') : null;
        $builder = \Nifus\AdminPanel\Helper::loadConfig('classes/'.$module);


        $form = $builder->config('formbuilder');
        $form->setId($id);

       // \Log::info($form->render());
        return \Response::json(
            [
                'content'=>\View::make('admin-panel::views/Edit/Form')
                        ->with('form',$form)
                        ->with('id',$id)
                        ->render()
            ]
        );
    }



}
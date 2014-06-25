<?php
Namespace Nifus\AdminPanel;


Class Edit extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.Index';

    function Form($module){
        $id = \Input::has('id') ? \Input::get('id') : null;
       // $submit_js = \Input::has('submit_js') ? \Input::get('submit_js') : null;


        $builder = \Nifus\AdminPanel\Helper::loadConfig('classes/'.$module);

        $form = $builder->config('formbuilder');
        $form = $form();
        $form->setId($id);

        $form->set('ajax',['url'=>route('ap.json.edit_url',['module'=>$module]) ]);

        if ( $form->isSubmit()  ){
            if ( true===$form->fails() ){
                return \Response::json(['error'=>$form->errors()]);
            }else{
                if ( false!==$form->save() ){
                    return \Response::json(['msg'=>'Изменения сохранены']);
                }else{
                    return \Response::json(['msg'=>$form->error()]);

                }

            }
        }

        // \Log::info($form->render());
        return \Response::json(
            [
                'content'=>\View::make('admin-panel::views/Edit/Form')
                        ->with('module',$module)
                        ->with('form',$form)
                        ->with('id',$id)
                        ->render()
            ]
        );
    }

    function Delete($module){
        $id = \Input::has('id') ? \Input::get('id') : null;
        $builder = \Nifus\AdminPanel\Helper::loadConfig('classes/'.$module);
        $model_config = $builder->config('model');
        $model = $model_config['name'];
        $object = $model::find($id);
        if ( !is_null($object) ){
            $object->delete();
        }
        return \Response::json(
            [
                'msg'=>'Изменения сохранены'
            ]
        );
    }



}
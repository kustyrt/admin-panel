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
        if ( $form->isSubmit() && true!==$form->fails()  ){
            try {
                $credentials = array(
                    'email'    => \Input::get('email'),
                    'password' => \Input::get('pass')
                );
                \Log::info($credentials);

                $user = \Sentry::authenticate($credentials, false);
                \Event::fire('user.login', $user);
                return \Redirect::route('ap.main');
            }catch (\Exception $e) {
                $form->setError(trans('admin-panel::admin.error_auth'));
            }
        }
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
<?php
Namespace Nifus\AdminPanel;


Class User extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.login';

    /**
     * auth form
     *
     * @return mixed
     */
    function Login(){

        if ( \Config::get('admin-panel::config.auth')=='username' ){
            $field = \Nifus\FormBuilder\FormBuilder::createField('text')
                ->setName('username')->setLabel( trans('admin-panel::admin.username') )
                ->setClass('form-control')->setValid(['required'],trans('admin-panel::admin.username_error'));
        }else{
            $field = \Nifus\FormBuilder\FormBuilder::createField('text')
                ->setName('email')->setLabel( trans('admin-panel::admin.email') )
                ->setClass('form-control')->setValid(['email'],trans('admin-panel::admin.email_error'));
        }

        $form = \Nifus\FormBuilder\FormBuilder::create('auth_form')
            ->setRender('array')->setExtensions(['Placeholder','Validetta'])
            ->setFields([

                $field,

                    \Nifus\FormBuilder\FormBuilder::createField('password')
                    ->setName('pass')->setLabel( trans('admin-panel::admin.pass') )
                    ->setClass('form-control')->setValid(['min:4'],trans('admin-panel::admin.pass_error') ),

                \Nifus\FormBuilder\FormBuilder::createField('checkbox')
                    ->setName('remember_me')->setOptions(['1'=>trans('admin-panel::admin.remember_me')]),
                \Nifus\FormBuilder\FormBuilder::createField('button')->setName('button_input')
                    ->setValue( trans('admin-panel::admin.input') )->setClass('btn btn-danger')->setType('submit')
            ]);
        if ( $form->isSubmit() && true!==$form->fails()  ){

            try {
                $key = \Config::get('admin-panel::config.auth');
                $credentials = array(
                                $key    => \Input::get($key),
                                'password' => \Input::get('pass')
                );
                $user = \Sentry::authenticate($credentials, false);
                \Event::fire('user.login', $user);
                return \Redirect::route('ap.main');
            }catch (\Exception $e) {
                $form->setError(trans('admin-panel::admin.error_auth'));
            }
        }
        $this->layout->form=$form->render();
        $this->layout->is_email= \Config::get('admin-panel::config.auth')=='email' ? 1 : 0;
    }


    function Logout(){
        \Event::fire('user.logout', \Sentry::getUser());
        \Sentry::logout();
        return \Redirect::route('ap.login');
    }



}
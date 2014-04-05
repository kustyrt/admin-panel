<?php
Namespace Nifus\AdminPanel;


Class Login extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.login';

    /**
     * Форма авторизации
     *
     * @return mixed
     */
    function Index(){
        // генерируем формы
        $form = \Nifus\FormBuilder\FormBuilder::create('auth_form')
            ->setRender('array')->setExtensions(['Placeholder'])
            ->setFields([
                \Nifus\FormBuilder\FormBuilder::createField('text')
                    ->setName('email')->setLabel( trans('admin-panel::admin.email') )
                    ->setClass('form-control')->setValid(['email'],trans('admin-panel::admin.email_error')),

                \Nifus\FormBuilder\FormBuilder::createField('password')
                    ->setName('pass')->setLabel( trans('admin-panel::admin.pass') )
                    ->setClass('form-control')->setValid(['min:6'],trans('admin-panel::admin.pass_error') ),

                \Nifus\FormBuilder\FormBuilder::createField('checkbox')
                    ->setName('remember_me')->setOptions(['1'=>trans('admin-panel::admin.remember_me')]),
                \Nifus\FormBuilder\FormBuilder::createField('button')->setName('button_input')
                    ->setValue( trans('admin-panel::admin.input') )->setClass('btn btn-danger')->setType('submit')
            ]);

        if ( $form->isSubmit() && true!==$form->fails()  ){
            try {
                $credentials = array(
                                'login'    => \Input::get('email'),
                                'password' => \Input::get('pass')
                );
                $user = \Sentry::authenticate($credentials, \Input::get('button_input'));
                \Event::fire('user.login', $user);
                return \Redirect::route('ap.main');
            }catch (\Exception $e) {
                $form->setError(trans('admin-panel::admin.error_auth'));
            }
        }
        $this->layout->form=$form->render();
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
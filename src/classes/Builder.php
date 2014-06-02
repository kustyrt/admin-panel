<?php
Namespace Nifus\AdminPanel;

class Builder
{
    protected $panel,$config;

    function __construct( \Nifus\AdminPanel\AdminPanel $panel ){
        $this->panel = $panel;
        $this->config = $this->panel->config();
    }

    public function config($key = '')
    {
        if (empty($key)) {
            return $this->config;
        }
        if (!isset($this->config[$key])) {
            return null;
            //throw new ConfigException('Нет ключа ' . $key);
        }
        return $this->config[$key];
    }



    public function getJsonUrl(){

        return route('ap.json',['module'=>$this->config['config_file'],'action'=>$this->config['action']]);
    }

    protected function setConfig($key,$value){
        if ( empty($key) ){
            throw new ConfigException('Пустой ключ' );
        }
        $this->config[$key]=$value;
    }

    public function getTitle(){
        return $this->config('name');
    }

    public function getUrl(){
        return $this->config('config_file');
    }

    protected function getFilter(){
        $filter_form = $this->config('filter_form');
        //$filter_form->setExtensions(['AdminFilter']);
        if ( $filter_form instanceof \Nifus\FormBuilder\FormBuilder ){
            return $filter_form;
        }
        return null;
    }

    public function renderFilterForm(){
        $filter_form = $this->getFilter();
        if ( !is_null($filter_form) ){
            return $filter_form->render();
        }
        return null;
    }

    public function hasFilter(){
        $filter_form = $this->getFilter();
        if ( !is_null($filter_form) ){
            return true;
        }
        return false;
    }

    public function filterFieldUrl(){
        $filter = $this->config('filter');
        if ( !is_null($filter) ){
            return $filter;
        }
        return null;
    }

    public function getFilterFormId(){
        $filter_form = $this->getFilter();
        if ( is_null($filter_form) ){
            return null;
        }
        return $filter_form->form_name;

    }


}
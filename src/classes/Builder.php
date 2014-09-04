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
        }
        return $this->config[$key];
    }

    public function getField($field_name)
    {
        $fields = $this->config['fields'];
        foreach( $fields as $field ){
            if ( $field['name']==$field_name ){
                return $field;
            }
        }
        return false;
    }

    public function getButton($name)
    {
        $buttons = $this->config('buttons');
        if ( isset($buttons[$name]) ){
            return $buttons[$name];
        }

        return false;
    }

    public function getJsonColActions(){
        return json_encode($this->config['actions'] );
    }

    public function getJsonColPages(){
        return json_encode($this->config['pages'] );
    }

    public function getExistsMapping(){
        return (true===$this->config['mapping']) ? 'true' : 'false';
    }

    public function getCustomEdit(){
        if ( isset($this->config['edit']) &&  false===$this->config['edit'] ){
            return 0;
        }
        return isset($this->config['custom_edit'] ) ? 1 : 0;
    }
    public function getExelUrl(){
        return route('ap.exel',['module'=>$this->config['config_file'],'action'=>$this->config['action']]);
    }
    public function getJsonUrl(){
        return route('ap.json',['module'=>$this->config['config_file'],'action'=>$this->config['action']]);
    }
    public function getModule(){
        return $this->config['config_file'];
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
            return $filter['listing_url'];
        }
        return null;
    }

    public function filterFieldKey(){
        $filter = $this->config('filter');
        if ( !is_null($filter) ){
            return $filter['key'];
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

    public function getButtons(){
        $configs = $this->config('buttons');

        $buttons = ['create'=>['type'=>'default','id'=>'listing_add_button','title'=>'Добавить','data-id'=>'listing_add_button']];
        if ( !is_null($configs) ){
            $buttons=array_merge($buttons,$configs);
        }
        $result = [];

        foreach( $buttons as $key=>$config ){
            if ( is_null($config) ){
                continue;
            }
            $config['class'] = !isset($config['type']) ? 'btn btn-default' : 'btn btn-'.$config['type'];
            if ( isset($config['method']) ){
                $config['data-button-open'] = route('ap.page',['module'=>$this->config['config_file'] ]);
                unset($config['method']);
            }
            $attrs='';
            foreach( $config as $k=>$v ){
                $attrs.=' '.$k.'="'.$v.'"';
            }
            $result[$key]=['title'=>$config['title'],'attrs'=>$attrs];
        }
        return $result;

    }


}
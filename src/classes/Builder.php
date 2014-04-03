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

            throw new ConfigException('Нет ключа ' . $key);
        }
        return $this->config[$key];
    }

    /*
    public function execute(){

        switch($this->config['action']){
            case('listing'):
                return Builder\Listing::create($this)->execute();
                break;
            case('listingJson'):
                return Builder\Listing::create($this)->execute();
                break;
            case('Edit'):
                return Builder\Listoing::create($this)->execute();
                break;
        }
        //return $this;
    }*/


    public function getJsonUrl(){

        return route('ap.json',['model'=>$this->config['config_file'],'action'=>$this->config['action']]);
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


}
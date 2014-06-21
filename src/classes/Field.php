<?php
namespace Nifus\AdminPanel;

class Field
{
    private $config = [];

    public function __construct($name)
    {
        $this->setConfig('name',$name);
    }

    public function title($title){
        $this->setConfig('title',$title);
        return $this;
    }
    public function width($width){
        $this->setConfig('width',$width);
        return $this;
    }

    public function filter($url,$filter_key){
        $this->setConfig('listing_url',route('ap.listing',['module'=>$url]));
        $this->setConfig('filter_key',$filter_key);
        $this->setConfig('name','filter');
        return $this;
    }

    public function action($url){
        $this->setConfig('action', $url);
        return $this;
    }

    public function sort($key,$order){
        $this->setConfig('sort',['key'=>$key,'order'=>$order]);
        return $this;
    }

    public function hidden($flag){
        $flag = !empty($flag) ? true : false;
        $this->setConfig('hidden',$flag);
        return $this;
    }

    public function getConfig($key=''){
        if ( empty($key) ){
            return $this->config;
        }
        if ( !isset($this->config[$key]) ){
            throw new ConfigException('Пустой ключ' );
        }
        return $this->config[$key];
    }
    protected function setConfig($key,$value){
        if ( empty($key) ){
            throw new ConfigException('Пустой ключ' );
        }
        $this->config[$key]=$value;
    }

}
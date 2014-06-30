<?php
namespace Nifus\AdminPanel;

class Field
{
    static $names=1000;
    private $config = [];

    public function __construct($name=null)
    {
        if ( is_null($name) ){
            $name = 'a'.self::$names;
            self::$names++;
        }
        $this->setConfig('name',$name);
    }


    public function content($title){
        $this->setConfig('content',$title);
        return $this;
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

    public function action($url,$key='id',$title=null){

        if ( is_string($url) ){
            $this->setConfig('action', ['url'=>$url,'key'=>$key,'title'=>$title]);
            //$this->setConfig('formatter', 'Ap.actionButton');
        }else{
            $this->setConfig('page', ['url'=>$url,'key'=>$key,'title'=>$title]);
            //$this->setConfig('formatter', 'Ap.actionButtonView');

        }
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
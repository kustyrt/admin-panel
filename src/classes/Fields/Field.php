<?php
namespace Nifus\AdminPanel;

class Field extends Base
{
    static $names=1;

    static function create( array $config){
        $field = new Field;
        foreach($config as $key=>$value ){
            $field->$key = $value;
        }
        return $field;
    }

    public function __construct($name=null)
    {
        if ( is_null($name) ){
            $name = 'a'.self::$names;
            self::$names++;
        }
        $this->name = $name;
    }



    public function title($title){
        $this->title = $title;
        return $this;
    }
    public function width($width){
        $this->width = $width;
        return $this;
    }

    public function sort($key,$order){
        $this->sort = ['key'=>$key,'order'=>$order];
        return $this;
    }

    public function hidden($flag){
        $flag = !empty($flag) ? true : false;
        $this->hidden=$flag;
        return $this;
    }


    public function config(){
        $this->title = !isset($this->config['title']) ? $this->name : $this->title ;
        return $this->config;
    }


}
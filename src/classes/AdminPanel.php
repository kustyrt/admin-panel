<?php
namespace Nifus\AdminPanel;

class AdminPanel
{
    private
        $config=[

            ],
        $formbuilder,
        $menu=[];


    static function create($prefix=''){
            $panel = new AdminPanel($prefix);

            return $panel;

    }

    static function structure(){
        return new AdminPanel;
    }

    /**
     * Создаём пункт меню
     *
     */
    static function createItem($name){
        $menu = new MenuItem($name);
        return $menu;
    }


    static function createField($name){
        $field = new Field($name);
        return $field;
    }

    function __construct($prefix=''){
        if ( !empty($prefix) && true === Helper::CheckPrefix($prefix) ){
            $this->setConfig('prefix',$prefix);
        }
        $this->menu =  new Menu;
    }



    public function menu(array $items){
        foreach( $items as $item ){
            $this->menu->setItem($item);
        }
        return $this;
    }

    /**
     * Устанавливаем модель
     *
     * @param $class_name
     * @return $this
     * @throws ConfigException
     */
    public function model($class_name){
        if ( false===class_exists($class_name) ){
            throw new ConfigException('Класс '.$class_name.' не найден' );
        }
        $this->setConfig('model',['name'=>$class_name]);

        return $this;
    }

    /**
     * Устанавливаем данные для редактирования. Если у нас не модель а конфиг файл
     *
     * @param $array
     * @return $this
     * @throws ConfigException
     */
    public function data( array $array){
        if ( false===is_array($array) ){
            throw new ConfigException('В качестве источника данных должен выступать массив' );
        }
        $this->setConfig('data',$array);
        return $this;
    }

    /**
     * Название страницы
     *
     * @param $title
     * @return $this
     */
    public function title( $title){
        $this->setConfig('name',$title);
        return $this;
    }

    public function listingFields(array $fields){
        $configs=[];
        foreach( $fields as $field ){
            if ( !$field instanceof  \Nifus\AdminPanel\Field ){
                throw new ConfigException('\Nifus\AdminPanel\Field' );
            }
            $configs[]=$field->getConfig();
        }
        $this->setConfig('fields',$configs);

        return $this;
    }

    public function editFields($closure){
        $formBuilder = $closure();
        if ( !$formBuilder instanceof  \Nifus\FormBuilder\FormBuilder ){
            throw new ConfigException('\Nifus\FormBuilder\FormBuilder ' );
        }
        $this->formbuilder = $formBuilder;
        return $this;
    }



    public function config($key=''){
        if ( empty($key) ){
            return $this->config;
        }
        if ( !isset($this->config[$key]) ){
            throw new ConfigException('Нет ключа '.$key );
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
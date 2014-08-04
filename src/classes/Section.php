<?php
namespace Nifus\AdminPanel;


class Section extends Base
{

    private
        $model,$formbuilder;

    function __construct($prefix = '')
    {
        if (!empty($prefix) && true === Helper::CheckPrefix($prefix)) {
            $this->setConfig('prefix', $prefix);
        }
    }

    /**
     * Загружаем секцию по названию (news/post)
     * @param $section
     * @return bool
     */
    static function load($section){
        $object = Helper::loadStructure($section);
        if ( false!==$object ){
            $object->path=$section;
        }
        return $object;
    }


    public function getTitle(){
        return $this->config['title'];
    }

    public function getPath(){
        return $this->config['path'];
    }

    public function getModel(){
        return $this->model;
    }

    /**
     * Название страницы
     *
     * @param $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Ex news/posts
     *
     * @param $path
     * @return $this
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
    }



    /**
     * Устанавливаем модель
     *
     * @param $class_name
     * @param $closure
     * @return $this
     * @throws ConfigException
     */
    public function model($class_name,$closure='')
    {
        if (false === class_exists($class_name)) {
            throw new ConfigException('Класс ' . $class_name . ' не найден');
        }
        $model = new $class_name;
        $key=$model->getKeyName();
        if ( !empty($closure) ){
            $model = $closure($model);
        }
        $this->setConfig('model', ['name' => $class_name,'model'=>$model,'key'=>$key]);
        $this->model = $model;
        return $this;
    }

    public function listingFields(array $fields,$dis_edit_button=false,$dis_delete_button=false )
    {
        $configs = [];
        foreach ($fields as $field) {
            if ( is_string($field) ){
                $field = Field::create(['name'=>$field]);
            } elseif (is_array($field)) {
                if (!isset($field['type'])) {
                    $class = '\Nifus\AdminPanel\Field';
                } else {
                    $class = '\Nifus\AdminPanel\Field\\' . $field['type'];
                }
                if (!class_exists($class)) {
                    throw new ConfigException('Class no exists: ' . $class);
                }
                $field = $class::create($field);

            } elseif (!$field instanceof \Nifus\AdminPanel\Field) {
                throw new ConfigException('\Nifus\AdminPanel\Field');
            }
            $config = $field->config();


            if ( isset($config['filter_key']) ){
                $this->filter = ['listing_url'=>$config['listing_url'],'key'=>$config['filter_key'] ];
            }
            //  поля для action
            if ( isset($config['action']) ){
                //$actions = $this->config['actions'];
                $actions[]=['url'=>$config['action']['url'],'key'=>$config['action']['key'],'name'=>$config['name'] ];
                $this->actions = $actions;
            }
            if ( isset($config['page']) ){
                //$page = $this->config['pages'];
                $pages[]=['url'=>$config['page']['url'],'key'=>$config['page']['key'],'name'=>$config['name'] ];
                $this->pages = $pages;
            }
            $configs[] = $config;
        }

        $this->fields = $configs;
        return $this;
    }

    /**
     * Устанавливаем данные для редактирования. Если у нас не модель а конфиг файл
     *
     * @param $array
     * @return $this
     * @throws ConfigException
     */
    public function data(array $array)
    {
        if (false === is_array($array)) {
            throw new ConfigException('В качестве источника данных должен выступать массив');
        }
        $this->data = $array;
        return $this;
    }





    /**
     * Передаём formbuilder для вывода формы
     * @param $closure
     * @return $this
     */
    public function filtersForm( $closure )
    {
        $this->filter_form = $closure();
        return $this;
    }

    /*
    public function edit($flag){
        $this->setConfig('edit', $flag);

        return $this;
    }

    public function add($flag){
        $this->setConfig('add', $flag);
        $this->setConfig('fast_edit', true);
        return $this;
    }

    public function delete($flag){
        $this->setConfig('delete', $flag);
        $this->setConfig('fast_edit', true);
        return $this;
    }*/

    public function editFields($closure)
    {
        //$this->setConfig('custom_edit', true);
        $this->formbuilder = $closure;
        $this->setConfig('formbuilder', $closure);
        return $this;
    }

    public function buttons($configs){
        $this->buttons = $configs;
        return $this;
    }


    public function includeJs($file){
        return $this;
    }

    public function includeCss($file){

        return $this;
    }



}
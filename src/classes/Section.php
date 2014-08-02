<?php
namespace Nifus\AdminPanel;


class Section extends Base
{

    private
        $model;

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


    public function path($path)
    {
        $this->path = $path;
        return $this;
    }


    public function setConfig($key, $value)
    {
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        $this->config[$key] = $value;
    }

    //

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




    public function listingFields(array $fields)
    {
        $configs = [];
        foreach ($fields as $field) {
            if (!$field instanceof  \Nifus\AdminPanel\Field) {
                throw new ConfigException('\Nifus\AdminPanel\Field');
            }
            $config = $field->getConfig();
            $configs[] = $config;
            if ( isset($config['filter_key']) ){
                $this->setConfig('filter',['listing_url'=>$config['listing_url'],'key'=>$config['filter_key'] ]);
            }
            //  поля для action
            if ( isset($config['action']) ){
                //$actions = $this->config['actions'];
                $actions[]=['url'=>$config['action']['url'],'key'=>$config['action']['key'],'name'=>$config['name'] ];
                $this->setConfig('actions',$actions);
            }
            if ( isset($config['page']) ){
                //$page = $this->config['pages'];
                $pages[]=['url'=>$config['page']['url'],'key'=>$config['page']['key'],'name'=>$config['name'] ];
                $this->setConfig('pages',$pages);
            }
        }
        $this->setConfig('fields', $configs);
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
        $this->setConfig('data', $array);
        return $this;
    }





    /**
     * Передаём formbuilder для вывода формы
     * @param $closure
     * @return $this
     */
    public function filtersForm( $closure )
    {
        $this->setConfig('filter_form', $closure());
        return $this;
    }


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
    }

    public function editFields($closure)
    {
        $this->setConfig('custom_edit', true);
        $this->formbuilder = $closure;
        $this->setConfig('formbuilder', $closure);
        return $this;
    }

    public function buttons($configs){
        $this->setConfig('buttons', $configs);
        return $this;
    }


    public function includeJs($file){

        return $this;
    }

    public function includeCss($file){

        return $this;
    }

}
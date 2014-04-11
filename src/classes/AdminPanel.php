<?php
namespace Nifus\AdminPanel;

class AdminPanel
{
    private
        $config = [],
        //$formbuilder,
        $menu = [];

    function __construct($prefix = '')
    {
        if (!empty($prefix) && true === Helper::CheckPrefix($prefix)) {
            $this->setConfig('prefix', $prefix);
        }
        $this->menu = new Menu;
        $this->registerBreadcrumbs();
    }

    protected function setConfig($key, $value)
    {
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        $this->config[$key] = $value;
    }

    static function create($prefix = '')
    {
        $panel = new AdminPanel($prefix);
        return $panel;
    }

    static function structure()
    {
        return new AdminPanel;
    }

    /**
     * Создаём пункт меню
     *
     */
    static function createItem($name,$title='')
    {
        $item = new MenuItem($name);
        $item->title($title);
        return $item;
    }

    static function createField($name)
    {
        $field = new Field($name);
        return $field;
    }

    public function menu(array $items)
    {
        foreach ($items as $item) {
            $this->menu->setItem($item);
        }
        return $this;
    }


    public function access( $access,$group,$user=0 )
    {
        $this->setConfig('access',['group'=>$group,'access'=>$access,'user'=>$user]);
        return $this;
    }


    public function getMenu(){
        return $this->menu->getMenu();
    }

    public function activeMenuItem($item){

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
        $model = $closure($model);

        $this->setConfig('model', ['name' => $class_name,'model'=>$model,'key'=>$key]);


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
     * Название страницы
     *
     * @param $title
     * @return $this
     */
    public function title($title)
    {
        $this->setConfig('name', $title);
        return $this;
    }

    public function listingFields(array $fields)
    {
        $configs = [];
        foreach ($fields as $field) {
            if (!$field instanceof  \Nifus\AdminPanel\Field) {
                throw new ConfigException('\Nifus\AdminPanel\Field');
            }
            $configs[] = $field->getConfig();
        }
        $this->setConfig('fields', $configs);

        return $this;
    }


    public function edit($flag){
        $this->setConfig('edit', $flag);
        $this->setConfig('fast_edit', true);

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

        //$formBuilder = $closure();
        /*dd( var_dump($formBuilder) );
        if (!$formBuilder instanceof  \Nifus\FormBuilder\FormBuilder) {
            throw new ConfigException('\Nifus\FormBuilder\FormBuilder ');
        }*/
        $this->formbuilder = $closure;
        $this->setConfig('formbuilder', $closure);

        return $this;
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

    public function includeJs($file){
        $files = $this->config('js');
        $files = is_array($files) ? $files : [];
        if ( !in_array($file,$files) ){
            $files[]=$file;
        }
        $this->setConfig('js', $files);
        return $this;
    }
    /*
    public function order($key,$value){
        if ( !isset($this->config['order']) ){
            $this->config['order']=[];
        }
        if ( empty($key) ){
            throw new ConfigException('Нет ключа ' . $key);
        }
        $this->config['order'][$key]=$value;
    }

    public function orders($orders){
        foreach($orders as $key=>$value ){
            $this->order($key,$value);
        }
    }*/

    private function registerBreadcrumbs()
    {
        $aliases = \Config::get('app.aliases');
        //  Если пакет стоит, то регим  хлебные крошки для стат страниц
        if ( false===isset($aliases['Breadcrumbs']) ) {
            return false;
        }

        \Breadcrumbs::register('ap.dashboard', function($breadcrumbs) {
            $breadcrumbs->push('Home', '/');
            $breadcrumbs->push('Dashboard', route('ap.main'));
        });

        \Breadcrumbs::register('ap.item.listing', function($breadcrumbs,$item) {
            $breadcrumbs->parent('ap.dashboard');
            $breadcrumbs->push($item->getTitle(), route('ap.listing',$item->getUrl() ) );
        });

    }


}
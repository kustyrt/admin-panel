<?php
namespace Nifus\AdminPanel;


class Structure
{

    private
        $items = [],
        $config = [];


    function __construct($prefix = '')
    {
        if (!empty($prefix) && true === Helper::CheckPrefix($prefix)) {
            $this->setConfig('prefix', $prefix);
        }
        $this->registerBreadcrumbs();
    }

   /* public function configPath($path){
        $this->setConfig('path',$path);
        return $this;
    }*/

    public function header( $name)
    {
        $this->setConfig('name',$name);
        return $this;
    }

    public function item($item)
    {
        array_push($this->items,$item) ;
        return $this;
    }

    public function access( $access,$group,$user=0 )
    {
        $this->setConfig('access',['group'=>$group,'access'=>$access,'user'=>$user]);
        return $this;
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

    public function includeCss($file){
        $files = $this->config('css');
        $files = is_array($files) ? $files : [];
        if ( !in_array($file,$files) ){
            $files[]=$file;
        }
        $this->setConfig('css', $files);
        return $this;
    }


    public function getItems(){
        return $this->items;
    }
    ////////////



    public function setConfig($key, $value)
    {
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        $this->config[$key] = $value;
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
<?php
namespace Nifus\AdminPanel;


class AdminPanel
{

    /**
     * Create admin structure
     * @param array $items
     * @return Structure
     * @throws \Exception
     */
    static function createStructure(array $items)
    {
        if ( sizeof($items)==0 ){
            throw new \Exception('Не задано меню');
        }
        $admin = new Structure;
        foreach( $items as $item ){
            if ( is_array($item) ){
                $admin->menu->setItem( MenuItem::create($item) );
            }elseif( $item instanceof MenuItem ){
                $admin->menu->setItem($item);
            }else{
                throw new \Exception('Неправильный формат');
            }
        }
        return $admin;
    }




    /**
     * Создаём раздел
     * @param string $prefix
     * @return AdminPanel
     */
    static function createSection($prefix = '')
    {
        $panel = new Section($prefix);
        return $panel;
    }

    static function createField($name)
    {
        $field = new Field($name);
        return $field;
    }

    static function createItem($name,$title='')
    {
        $item = new MenuItem($name);
        $item->title($title);
        $item->setUrl( route('ap.listing',$name) );
        return $item;
    }




    public function header( $name)
    {
        $this->setConfig('name',$name);
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

    public function getMenu(){
        return $this->menu->getMenu();
    }



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


}
<?php
namespace Nifus\AdminPanel;

class MenuItem
{
    private $title;
    private $name;
    private $url;
    private $sub=[];

    public function __construct($name){
        if ( false===Helper::CheckPrefix($name) ){
            //...
        }
        $this->name=$name;
    }

    static function create(array $config){
        $item = new MenuItem($config['name']);
        foreach( $config as $key=>$value ){
            $item->$key=$value;
        }
        return  $item;
    }

    public function title($title){
        $this->title = $title;
    }
    public function sub($sub_menu){
        foreach( $sub_menu as $menu ){
            $builder = Builder\Listing::create($menu);
            if ( false===$builder ){
                continue;
            }
            $this->sub[]=['title'=>$builder->getTitle(),'url'=>route('ap.listing',$builder->getUrl())];
        }
        return $this;
    }

    public function getName(){
        return $this->name;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getUrl(){
        return $this->url;
    }
    public function getSub(){
        return  $this->sub;
    }

    public function setUrl($url)
    {
        $this->url=$url;
        return $this;
    }
}
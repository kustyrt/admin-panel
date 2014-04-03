<?php
namespace Nifus\AdminPanel;

class MenuItem
{
    private $title;
    private $name;
    private $sub=[];

    public function __construct($name){
        if ( false===Helper::CheckPrefix($name) ){
            //...
        }
        $this->name=$name;
    }

    public function title($title){
        $this->title = $title;
    }
    public function sub($sub_menu){
        foreach( $sub_menu as $menu ){
            \Log::info($menu);
            $builder = Builder\Listing::create($menu);
            if ( false===$builder ){
                continue;
            }
            $this->sub[]=['title'=>$builder->getTitle(),'url'=>$builder->getUrl()];
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
        return $this->title;
    }
    public function getSub(){
        return  $this->sub;
    }


}
<?php
namespace Nifus\AdminPanel;

class MenuItem
{
    private $name;
    private $sub=[];

    public function __construct($name){
        if ( false===Helper::CheckPrefix($name) ){
            //...
        }
        $this->name=$name;
    }

    public function sub($sub_menu){
        foreach( $sub_menu as $menu ){
            if ( false===Helper::CheckPrefix($menu) ){
                    //...
            }
            $this->sub[]=$menu;
        }
        return $this;
    }



}
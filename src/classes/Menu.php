<?php
namespace Nifus\AdminPanel;

class Menu
{
    private $arrayMenu = [];



    function setItem(MenuItem $item)
    {
        $this->arrayMenu[]=$item;
    }

    function getMenu()
    {
        $rows = [];
        foreach( $this->arrayMenu as $menu ){
            $rows[]=['title'=>$menu->getTitle(),'url'=>$menu->getUrl(),'sub'=>$menu->getSub()];
        }
        return $rows;
    }
}
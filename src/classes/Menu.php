<?php
namespace Nifus\AdminPanel;

class Menu extends Base
{

    public   function __construct($items){
        $this->items = $items;
    }


    public  function active($path){
        $this->active = $path;
    }

    function getArray()
    {
        $rows = [];
        foreach( $this->items as $item ){
            $rows[]=['title'=>$item->title,'url'=>$item->url,'sub'=>$item->sub];
        }
        return $rows;
    }
}
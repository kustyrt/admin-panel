<?php
namespace Nifus\AdminPanel;


class MenuItem extends Base
{

    static function create(array $config){
        $item = new MenuItem();
        if ( empty($config['title']) ){
            throw new \Exception('Не задан title для пункта меню');
        }
        $item->title = $config['title'];
        if ( empty($config['url']) ){
            throw new \Exception('Не задан URL для пункта меню');
        }
        $item->url = route('ap.listing',$config['url']);
        $sub = isset($config['sub']) ? $config['sub'] : [];
        $item->sub($sub);
        return  $item;
    }

    public function sub(array $menu){
        $sub = [];
        foreach( $menu as $item ){
            $section = Helper::loadStructure($item);
            if ( false===$section ){
                continue;
            }
            $sub[]=['title'=>$section->title,'url'=>route('ap.listing',$section->path)];
        }
        $this->sub = $sub;
        return $this;
    }

}
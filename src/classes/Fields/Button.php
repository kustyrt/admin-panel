<?php
namespace Nifus\AdminPanel\Field;

class Button extends \Nifus\AdminPanel\Field
{

    public function page($url,$key='id',$title=null){

            $this->page= ['url'=>$url,'key'=>$key,'title'=>$title];

        return $this;
    }
    public function action($url,$key='id',$title=null){

            $this->action= ['url'=>$url,'key'=>$key,'title'=>$title];

        return $this;
    }

    public function filter($url,$filter_key){
        $this->listing_url=route('ap.listing',['module'=>$url]);
        $this->filter_key=$filter_key;
        $this->name='filter';
        return $this;
    }


    public function content($title){
        $this->content=$title;
        return $this;
    }
}
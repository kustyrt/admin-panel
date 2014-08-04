<?php
namespace Nifus\AdminPanel\Field;

class ButtonGroup extends \Nifus\AdminPanel\Field
{
    static $names=1000;
    private $config = [];


    public function action($url,$key='id',$title=null){
        if ( is_string($url) ){
            $this->setConfig('action', ['url'=>$url,'key'=>$key,'title'=>$title]);
            //$this->setConfig('formatter', 'Ap.actionButton');
        }else{
            $this->setConfig('page', ['url'=>$url,'key'=>$key,'title'=>$title]);
            //$this->setConfig('formatter', 'Ap.actionButtonView');
        }
        return $this;
    }


}
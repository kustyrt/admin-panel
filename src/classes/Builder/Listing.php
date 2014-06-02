<?php
Namespace Nifus\AdminPanel\Builder;

Use \Nifus\AdminPanel\Builder  as Builder ;

class Listing extends Builder
{
    protected $total;
    protected $on_page=10;
    protected $page;

    static function create($config){
        $result = \Nifus\AdminPanel\Helper::loadConfig('classes/'.$config);
        if ( !$result instanceof \Nifus\AdminPanel\AdminPanel ){
            return false;
        }
        $builder = new Builder\Listing($result);
        $builder->setConfig('action','listing');
        $builder->setConfig('config_file',$config);
        return $builder;
    }


    public function getJsonColNames(){
        $result = [];
        $fields = $this->panel->config('fields');
        foreach( $fields as $field ){
            $result[]=isset($field['title']) ? $field['title'] : $field['name'];
        }
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    public function getJsonColModel(){
        $result = [];
        $fields = $this->panel->config('fields');
        $model = $this->panel->config('model');
        foreach( $fields as $field ){
            $size=sizeof($result);
            $result[$size]['editable']=true;
            $result[$size]['name']=$field['name'];
            $result[$size]['index']=$field['name'];
            if ( isset($field['width']) ){
                $result[$size]['width']= $field['width'];
            }
            if  (isset($model['key']) && $model['key']==$field['name'] ){
                $result[$size]['key']= true;
            }

        }
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    public function getData(){
        $model_config = $this->panel->config('model');
        $model = $this->panel->model;
        //$model_config['model'];
        $this->total = $model->count();
        \Log::info($model->getQuery()->toSql());
        $rows = $model->take($this->getRowNum())->skip(($this->page-1)*$this->getRowNum());
        $rows = $rows->get();
        $fields = $this->panel->config('fields');
        $data = [];
        foreach( $rows as $row ){
            $link = sizeof($data);
            foreach( $fields as $field ){
                $field_name = $field['name'];
                if  (isset($field['filter']) ){
                    $data[$link][$field_name] = route('ap.listing',['module'=>$field['filter'],'filter'=>$row->$field_name]);
                }else{
                    $data[$link][$field_name] = $row->$field_name;
                }
            }
        }
        return $data;
    }

    public function getRowNum(){
        return $this->on_page;
    }

    public function execute(){
        return \View::make('admin-panel::views.Main.Listing')->with('builder',$this);
    }

    public function getTotal(){
        return $this->total;
    }
    public function setPage($page){
        return $this->page=$page;
    }
    public function setOnPage($count){
        return $this->on_page=$count;
    }
    public function setFilter($filter){
        if ( !is_array($filter) || sizeof($filter)==0 ){
            return false;
        }
        foreach( $filter as $key=>$value ){
            if ( empty($value) ){
                continue;
            }
            if ( isset($_GET['operation'][$key]) ){
                switch($_GET['operation'][$key]){
                    case('like'):
                        $this->panel->model->where($key,'like',$value.'%');
                        break;
                }
            }else{
                $this->panel->model->where($key,$value);
            }
        }
    }



}


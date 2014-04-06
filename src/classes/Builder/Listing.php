<?php
Namespace Nifus\AdminPanel\Builder;

Use \Nifus\AdminPanel\Builder  as Builder ;

class Listing extends Builder
{
    protected $total;

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

            //key
        }
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    public function getData(){
        $model_config = $this->panel->config('model');
        $model = $model_config['model'];
        $rows = $model->get();
        $fields = $this->panel->config('fields');
        $data = [];
        $this->total = $model->count();
        foreach( $rows as $row ){
            $link = sizeof($data);
            foreach( $fields as $field ){
                $field_name = $field['name'];
                $data[$link][$field_name] = $row->$field_name;
            }
        }

        return $data;
    }

    public function getRowNum(){
        return 10;
    }

    public function execute(){
        return \View::make('admin-panel::views.Main.Listing')->with('builder',$this);
    }

    public function getTotal(){
        return $this->total;
    }



}


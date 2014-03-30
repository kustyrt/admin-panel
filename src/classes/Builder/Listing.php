<?php
Namespace Nifus\AdminPanel\Builder;

Use \Nifus\AdminPanel\Builder  as Builder ;

class Listing extends Builder
{


    static function create($config){
        if ( empty($config) ){
            return false;
        }
        if ( !file_exists(app_path().'/config/packages/nifus/admin-panel/classes/'.$config.'.php') ){
            return false;
        }
        $closure = require app_path().'/config/packages/nifus/admin-panel/classes/'.$config.'.php';
        $result = $closure();
        if ( !$result instanceof \Nifus\AdminPanel\AdminPanel ){
            throw new ConfigException('Ошибка чтения конфиг-файла. Должен быть возвращён объёкт \Nifus\AdminPanel\AdminPanel');
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
        //{name:'id',index:'id', width:55},
        $result = [];
        $fields = $this->panel->config('fields');
        foreach( $fields as $field ){
            $size=sizeof($result);

            $result[$size]['name']=$field['name'];
            $result[$size]['index']='id_'.$field['name'];
            if ( isset($field['width']) ){
                $result[$size]['width']= $field['width'];
            }

        }
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    public function getJsonData(){
        $config = $this->panel->config();
        $data = DataBuilder::create($this->panel);
        $data->set();
        $data->set();
        $data->set();
        $data->set();
        $data->get();
        dd($config);
        $result = [];
        return json_encode($result);
    }

    public function getJsonRowNum(){
        return 10;
    }

    public function execute(){


        return \View::make('admin-panel::views.Main.Listing')->with('builder',$this);
    }

}


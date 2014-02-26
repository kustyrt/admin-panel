<?php

namespace Nifus\AdminPanel;

Class AdminForm {

    private $fields;
    private $table;

    public function __construct($config)
    {
        $this->fields = $config['fields'];
        $this->table = $config['name'];
    }

    public function render($obj_data = null)
    {
        $data = [];
        foreach ($this->fields as $f) {
            $f['value'] = $obj_data ? $obj_data->$f['name'] : '';
            $view = 'admin::fields.'.$f['type'];
            $itmes[] = \View::make($view, $f)->render();
        }
        return $itmes;
    }

}
<?php
namespace Nifus\AdminPanel;

class Base
{
    protected
        $config = [];

    public function __set($key,$value){
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        $this->config[$key] = $value;
        return $this;
    }

    public function __get($key){
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        return $this->config[$key];
    }

}
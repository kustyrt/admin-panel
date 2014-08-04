<?php
namespace Nifus\AdminPanel;

class Base
{
    protected
        $config = [];

    public function setConfig($key, $value)
    {
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        $this->config[$key] = $value;
    }
    public function __set($key,$value){
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        $this->config[$key] = $value;
        return $this;
    }
    public function config(){
        return $this->config;
    }

    public function __get($key){
        if (empty($key)) {
            throw new ConfigException('Пустой ключ');
        }
        return $this->config[$key];
    }

}
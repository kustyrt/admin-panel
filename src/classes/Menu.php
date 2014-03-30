<?php
namespace Nifus\AdminPanel;

class Menu
{
    private $arrayMenu = [];

    public function __construct()
    {
        //$this->arrayMenu[$name]=[];
    }

    function setItem(MenuItem $item)
    {

    }

    function getMenu()
    {
        return 'li';
    }
}
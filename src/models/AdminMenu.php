<?php

namespace Nifus\AdminPanel;

Class AdminMenu {

    public static function getMainMenu()
    {
        $data = ['menu' => \Config::get('admin::menu')];
        return \View::make('admin::admin.main_menu', $data);
    }

}
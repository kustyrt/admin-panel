<?php

return Array(
    'admin_folder' => 'admin',
    'root_page' => '/news',
    'users' => [
        [
            'login' => 'max.khlystov@gmail.com',
            'password' => 'qweqweqwe'
        ]
    ],
    'news' => array(
        'title' 	=> 	'Новости',
        'prefix'	=>	'news',
        'menu'		=>	array(
            'Post'	=>	'Новости',
            'Config'=>	'Настройки',
            'category'=>'Категории'
        ),
        'model'	=>'\News',

        'fields'=> array(
            'title' => array(
                'title'=>'Заголовок',
                'sort'=>'DESC',
                'edit'=>'text'
            )
        ),

        'filter'=>array(
        ),

        'edit'=>array(
        ),
    )
);

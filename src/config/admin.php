<?php

array(
    'news'=>array(
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

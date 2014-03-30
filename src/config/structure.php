<?php

return  function(){
    return
        \Nifus\AdminPanel::structure()
            ->menu([
                \Nifus\AdminPanel::createItem('geo')->sub(['Country','Region','City'])
            ]);
};

/*[
    'users'=>array(
        'prefix'	=>	'users',
        'menu'		=>	array(
            'Users'	=>	'Пользователи',
            'Groups'=>	'Группы',
        ),
        'model'	=>'\Users',

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
];*/

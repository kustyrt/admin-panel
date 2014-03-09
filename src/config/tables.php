<?php

return [
    'news' => [
        'name' => 'news',
        'fields' => [
            'id' => [
                'name' => 'id',
                'type' => 'key',
                'title' => 'ID'
            ],
            'title' => [
                'name' => 'title',
                'type' => 'text',
                'title' => 'Заголовок'
            ],
            'desc' => [
                'name' => 'desc',
                'type' => 'textarea',
                'title' => 'Описание'
            ],
            'color' => [
                'name' => 'color',
                'type' => 'color',
                'title' => 'color'
            ],

        ]
    ],
];
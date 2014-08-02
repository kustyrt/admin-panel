admin-panel
===========



Листинг полей
===========

Сформируем таблицу с простыми текстовыми данными. 
```php
	listingFields(
		[
            \Nifus\AdminPanel\AdminPanel::createField('id')->title('#')->width(40),
            \Nifus\AdminPanel\AdminPanel::createField('UserFromGroup')->title('Роль'),
            \Nifus\AdminPanel\AdminPanel::createField('ToFio')->title('Кто'),
        ]
    )
```
Иногда нужны не только данные, но и кнопки для перехода на новые страницы.
Новая страница описывается тутже в замыкании:
```php
	listingFields(
		[
            \Nifus\AdminPanel\AdminPanel::createField('id')->title('#')->width(40),
            \Nifus\AdminPanel\AdminPanel::createFieldButton('Просмотр')->action(function($id,$row_name){
                        $post = \Tickets\Post::find($id);
                        $form =  \Nifus\Tickets\Post::getAddAdminTicketAnswerFormBlock($post->id);
                        return \View::make('admin/tickets/View')
                            ->with('post',$post)
                            ->with('answer_form',$form)
                            ->with('row_name',$row_name)
                            ->render();

                    },'id')->content('Просмотр'),
        ]
    )
```
Можем задать не только кнопку для перехода на другую страницу, но и кнопку для совершения действий над записью
```php
	listingFields(
		[
            \Nifus\AdminPanel\AdminPanel::createField('id')->title('#')->width(40),
            \Nifus\AdminPanel\AdminPanel::createFieldButton('Просмотр')->action(function($id,$row_name){
                        $post = \Tickets\Post::find($id);
                        $form =  \Nifus\Tickets\Post::getAddAdminTicketAnswerFormBlock($post->id);
                        return \View::make('admin/tickets/View')
                            ->with('post',$post)
                            ->with('answer_form',$form)
                            ->with('row_name',$row_name)
                            ->render();

                    },'id')->content('Просмотр'),
        ]
    )
```
Если нужно совместить несколько кнопок вместе, а не разносить их по отдельным колонкам таблицы, то
```php
	listingFields(
		[
            \Nifus\AdminPanel\AdminPanel::createFieldButtonGroup(
                [
                    \Nifus\AdminPanel\AdminPanel::createFieldButton('Просмотр')->action(function($id,$row_name){
                        $post = \Tickets\Post::find($id);
                        $form =  \Nifus\Tickets\Post::getAddAdminTicketAnswerFormBlock($post->id);
                        return \View::make('admin/tickets/View')
                            ->with('post',$post)
                            ->with('answer_form',$form)
                            ->with('row_name',$row_name)
                            ->render();

                    },'id')->content('Просмотр'),
                    \Nifus\AdminPanel\AdminPanel::createFieldButton('Просмотр')->action(function($id,$row_name){
                        $post = \Tickets\Post::find($id);
                        $form =  \Nifus\Tickets\Post::getAddAdminTicketAnswerFormBlock($post->id);
                        return \View::make('admin/tickets/View')
                            ->with('post',$post)
                            ->with('answer_form',$form)
                            ->with('row_name',$row_name)
                            ->render();

                    },'id')->content('Просмотр')
                ]
            ),
        ]
    )
```

Также можно на вход просто передать массив данных
```php
[
	['name'=>'id','title'=>'#','width'=>30,'sortable'=>false],
	[
		'name'=>'id','title'=>'#','width'=>30,'sortable'=>false,
		'name'=>'id','title'=>'#','width'=>30,'sortable'=>false
	]

]
```

Обычно пользователю требуется два стандартных действия: редактировать и удалить запись.
По умолчанию они добавляются в вашу таблицу.
Чтобы отключить их 
```php
listingFields(
		[
            \Nifus\AdminPanel\AdminPanel::createField('id')->title('#')->width(40),
            ...
        ],
        false,
        false
    )
```

Общие действия с данными таблицы.
По умолчанию у вас есть кнопка для добавления новых записей. Чтобы убрать её 
```php
$builder->buttons(['create'=>null])
```

также можно задавать другие кнопки общего назначения
```php
$builder->buttons(
	[
		['create'=>null],

		\Nifus\AdminPanel\AdminPanel::createButton('delete_selection')
			->title('Удалить выбранные записис')
			->class('')
			->action(function($ids){

			})
		)
	]
)
```

Управлять количеством записей на странице 
```php
->Paginator( $count_rows )
```

По умолчанию пагинатор включён и выдаёт по 10 записей
Если пережать null, то это отключит пагинацию на странице.

Сделать возможным массовое выделение записей
```php
->Multiselected()
```
По умолчанию отключено 

Группировка данных
```php
->Groups(id)
```
id - поле данных по которому идёт группировка



	

<div class="panel panel-default">
    <div class="panel-body">
        <button type="button" class="btn btn-default" id="edit_back_button">Назад</button>
        <button type="button" class="btn btn-default"  id="edit_refresh_button">Обновить</button>
        <button type="button" class="btn btn-default"  id="edit_save_button">Сохранить</button>
    </div>
</div>

<div class="page-header">

@if ( !empty($id) )
<h2>Изменить</h2>
@else
<h2>Добавить</h2>
@endif
</div>

<div class="panel panel-default">
    <div class="panel-body">
        {{$form->render()}}    </div>
</div>

<script type="text/javascript">

    Ap.initEditForm(
        {
            'id': {{$id}},
            'form' : '{{ $form->name_form }}'
        }
    )
</script>


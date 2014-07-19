<div class="panel panel-default">
    <div class="panel-body">
        <button type="button" class="btn btn-default" data-id="edit_back_button">Назад</button>
        <button type="button" class="btn btn-primary"  data-id="edit_refresh_button">Обновить</button>
        <button type="button" class="btn btn-success"  data-id="edit_save_button">Сохранить</button>
        <button type="button" class="btn btn-danger"  data-id="edit_del_button">Удалить</button>
    </div>
</div>

<div class="page-header">

@if ( !empty($id) )
<h2>Изменить</h2>
@else
<h2>Добавить</h2>
@endif
</div>

<div class="alert alert-danger hide" id="{{ $form->form_name }}Message">...</div>

<div class="panel panel-default">
    <div class="panel-body">
        {{$form->render()}}    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <button type="button" class="btn btn-default" data-id="edit_back_button">Назад</button>
        <button type="button" class="btn btn-primary"  data-id="edit_refresh_button">Обновить</button>
        <button type="button" class="btn btn-success"  data-id="edit_save_button">Сохранить</button>
        <button type="button" class="btn btn-danger"  data-id="edit_del_button">Удалить</button>
    </div>
</div>


<script type="text/javascript">
    $(function () {
            Ap.initEditForm(
                {
                    'id': {{$id}},
                    'form':'{{ $form->form_name }}',

                }
            )
    })
</script>



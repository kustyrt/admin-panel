<div class="panel" style="position:fixed;width:100%;height:150px;top:0px;background-color:red;">

    <div style="float:left;width:300px">
        <form method="post" action="/development">

            <strong>Экшен</strong>

            <p>{{$newActionSelect}}</p>

            <p><input type="text" placeholder="Описание" name="form[title]"/></p>

            <p><input type="submit" value="Сохранить"/></p>
        </form>
    </div>

    <form method="post" action="/development">
        <div><strong>Переменная</strong></div>
        <div style="float:left;width:300px">

            <p>{{$actionSelect}}</p>
            <p><input type="text" name="action[var]" placeholder="Новая переменная"/></p>
            <p><input type="text" name="action[options]" placeholder="Опция"/></p>
        </div>


        <div style="float:left;width:200px">
            <p>{{$TmplList}}</p>
            <p><input type="text" name="action[time_cache]" placeholder="Время кэша"/></p>
        </div>
        <div style="float:left;width:300px">
            <p></label><textarea name="action[tmpl]" id="" cols="30" rows="4" placeholder="Шаблон"></textarea></p>
            <p><input type="submit" value="Сохранить"/></p>
        </div>
        <div><a onclick="WINDOWS.close()">Закрыть</a></div>
    </form>

</div>
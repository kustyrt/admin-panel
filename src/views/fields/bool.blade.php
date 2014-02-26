<div class="form-group">
    <label for="exampleInputEmail1">{{$title}}</label>
    <select class="form-control" name="{{$name}}">
        @if ($value == 1)
            <option selected="selected" value="1">Да</option>
            <option value="0">Нет</option>
        @else
            <option value="1">Да</option>
            <option selected="selected" value="0">Нет</option>
        @endif
    </select>
</div>

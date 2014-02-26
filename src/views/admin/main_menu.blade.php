<ul id="nav">
    @foreach ($menu as $i)
        @if (isset($i['sub_menu']))
            <li class="has_sub">
                <a href="/admin/table/{{$i['table']}}">{{$i['title']}}

                </a>
                <ul>
                    @foreach ($i['sub_menu'] as $s_i)
                        <li><a href="/admin/table/{{$s_i['table']}}">{{$s_i['title']}}</a></li>
                    @endforeach
                </ul>
            </li>
        @else
            <li><a href="/admin/table/{{$i['table']}}">{{$i['title']}}</a></li>
        @endif

    @endforeach


</ul>
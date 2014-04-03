
<ul id="nav">
    @foreach( $menu as $item )
    @if( sizeof($item['sub'])>0 )

        <li class="has_sub"><a href="{{$item['url']}}"><i class="icon-home"></i> {{$item['title']}}</a>
            <ul>
                @foreach( $item['sub'] as $sub_item )
                <li><a href="{{$sub_item['url']}}">{{ $sub_item['title'] }}</a></li>
                @endforeach
            </ul>
        </li>
    @else
    <li ><a href="{{$item['url']}}"><i class="icon-home"></i> {{$item['title']}}</a>
    </li>
    @endif

    @endforeach

</ul>
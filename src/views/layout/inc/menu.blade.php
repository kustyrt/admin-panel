
<ul id="nav">
    <li ><a href="{{ route('ap.main')}}"><i class="icon-home"></i> На главную</a>

        @foreach( $menu as $item )
        @if( sizeof($item['sub'])>0 )
            <li class="has_sub"><a href="#">{{$item['title']}}</a>
                <ul>
                    @foreach( $item['sub'] as $sub_item )
                    <li  class="active"><a href="{{ $sub_item['url'] }}" class="active">{{ $sub_item['title'] }}</a></li>
                    @endforeach
                </ul>
            </li>
        @else
        <li ><a href="{{$item['url']}}">{{$item['title']}}</a>
        </li>
        @endif
    @endforeach
</ul>
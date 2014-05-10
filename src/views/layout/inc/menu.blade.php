
<ul   class="nav navbar-nav">
    <li ><a href="{{ route('ap.main')}}"><i class="icon-home"></i> На главную</a>

        @foreach( $menu as $item )
        @if( sizeof($item['sub'])>0 )
            <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$item['title']}}</a>
                <ul  class="dropdown-menu">
                    @foreach( $item['sub'] as $sub_item )
                    <li><a href="{{ $sub_item['url'] }}" >{{ $sub_item['title'] }}</a></li>
                    @endforeach
                </ul>
            </li>
        @else
        <li ><a href="{{$item['url']}}">{{$item['title']}}</a>
        </li>
        @endif
    @endforeach
</ul>
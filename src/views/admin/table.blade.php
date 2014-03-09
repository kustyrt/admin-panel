@extends('admin::layouts.main')

@section('content')


<div class="widget">

    <div class="widget-head">
        <a href="/admin/new-item/{{$table_config['name']}}" class="btn btn-primary pull-right">Добавить запись</a>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    @foreach ($table_config['fields'] as $k => $v)
                    @if (isset($_GET['order_type']) && $_GET['order_type'] == 'asc')
                    <th><a href="/{{\Request::path()}}/?order={{$v['name']}}&order_type=desc">{{$v['title']}}</a></th>
                    @else
                    <th><a href="/{{\Request::path()}}/?order={{$v['name']}}&order_type=asc">{{$v['title']}}</a></th>
                    @endif

                    @endforeach
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $i)
                    <tr>
                        @foreach ($table_config['fields'] as $k => $v)
                            <td>{{$i->$k}}</td>
                        @endforeach
                        <td style="width: 65px;">
                            <a class="btn btn-xs btn-default" href="/admin/edit-item/{{$table_config['name']}}/{{$i->id}}">
                                <i class="icon-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-default" href="/admin/delete-item/{{$table_config['name']}}/{{$i->id}}">
                                <i class="icon-remove"></i>
                            </a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>

        <div class="widget-foot">
            <div class="pull-right">
                @if (isset($_GET['order_type']) && isset($_GET['order_type']))
                {{$items->appends(array('order' => $_GET['order'], 'order_type' => $_GET['order_type']))->links()}}
                @else
                {{$items->appends(array('sort' => 'votes'))->links()}}
                @endif

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@stop
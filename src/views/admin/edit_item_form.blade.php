@extends('admin::layouts.main')

@section('content')

<div class="row">
    <div class="col-md-6">

        <div class="widget wgreen">

            <div class="widget-head">
                <div class="pull-left"></div>
                <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">

                <div class="padd">



                    <form action="/admin/edit-item/{{$table}}/{{$object_id}}" method="post">
                        @foreach ($form as $item)
                        {{$item}}
                        @endforeach
                        <a href="/admin/table/{{$table}}" class="btn btn-default">Отмена</a>

                        <input type="submit" class="btn btn-success pull-right" value="Изменить">
                    </form>

                </div>
            </div>
            <div class="widget-foot">
                <!-- Footer goes here -->
            </div>
        </div>










    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
</div>



@stop
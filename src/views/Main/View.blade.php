<div class="page-head">
    <h2 class="pull-left"><i class="icon-table"></i> {{$builder->getTitle()}}</h2>

    <div class="bread-crumb pull-right">
        {{ Breadcrumbs::render('ap.item.listing',$builder) }}
    </div>
    <div class="clearfix"></div>
</div>


<div class="matter">
    <div class="container">

        <div class="alert alert-danger hide" id="message">...</div>

        <div class="row" id="listing">
            <div class="panel panel-default">
                <div class="panel-body">
                    <button type="button" class="btn btn-default" id="listing_add_button">Добавить</button>
                    @if ( $builder->hasFilter() )
                    <button type="button" class="btn btn-default" id="filter_show_button" >Фильтровать</button>
                    @endif
                </div>
            </div>
            <div class="panel panel-default hide" id="filter_table">
                <div class="panel-body">
                    <h3>Фильтры</h3>
                    {{$builder->renderFilterForm()}}
                    <br style="clear:both"/>
                    <div class="rest-m"></div>
                    <hr/>
                    <button type="button" class="btn btn-default" id="filter_button" >Фильтровать</button>
                    <button type="button" class="btn btn-reset"  id="filter_reset_button">Очистить</button>
                </div>
            </div>

            <div class="col-md-12" >
                <table id="table"></table>
                <div id="pgwidth"></div>
            </div>
        </div>
        <div id="edit_form"></div>

    </div>
</div>




<link rel="stylesheet" type="text/css" media="screen" href="{{asset('packages/nifus/admin-panel/js/grid/css/ui.css')}}" />
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('packages/nifus/admin-panel/js/grid/css/ui.jqgrid.css')}}" />

<script src="{{asset('packages/nifus/admin-panel/js/grid/js/i18n/grid.locale-en.js')}}" type="text/javascript"></script>
<script src="{{asset('packages/nifus/admin-panel/js/grid/js/jquery.jqGrid.min.js')}}" type="text/javascript"></script>


<script type="text/javascript">
    $(function(){
        Ap.init();
        Ap.initEditForm(
            {
                'url': '{{route('ap.json.edit_url',['module'=>$builder->config('config_file')])}}',
                'delete_url' :'{{route('ap.json.delete_url',['module'=>$builder->config('config_file')])}}'
            }
        );
        Ap.initFilterListing('{{$builder->filterFieldUrl()}}','{{$builder->filterFieldKey()}}');
        @if( $builder->hasFilter() )
            @if( \Input::has('filter') )
                Ap.initFilterForm('{{$builder->getFilterFormId()}}',{{ json_encode($_GET['filter'])}});
            @else
                Ap.initFilterForm('{{$builder->getFilterFormId()}}',null);
            @endif
        @endif
        Ap.initDataTable(
            {
                'url': '{{$builder->getJsonUrl()}}',
                'colNames' :{{$builder->getJsonColNames()}},
                'colModel' :{{$builder->getJsonColModel()}},
                'rowNum' :{{$builder->getRowNum()}},
                'custom_edit' : 1,
                //'fast_edit' : 0,
                'colActions' : {{$builder->getJsonColActions()}},
                'colPages' : {{$builder->getJsonColPages()}},
            }
        );



    })
</script>

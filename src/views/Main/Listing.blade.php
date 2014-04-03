<div class="page-head">
    <h2 class="pull-left"><i class="icon-table"></i> {{$builder->getTitle()}}</h2>

    <div class="bread-crumb pull-right">
        {{ Breadcrumbs::render('ap.item.listing',$builder) }}

    </div>

    <div class="clearfix"></div>

</div>


<div class="matter">
    <div class="container">


        <div class="row">

            <div class="col-md-12">

                <table id="table"></table>
                <div id="pgwidth"></div>

            </div>

        </div>


    </div>
</div>


</div>


<link rel="stylesheet" type="text/css" media="screen" href="{{asset('packages/nifus/admin-panel/js/grid/css/ui.css')}}" />
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('packages/nifus/admin-panel/js/grid/css/ui.jqgrid.css')}}" />

<script src="{{asset('packages/nifus/admin-panel/js/grid/js/i18n/grid.locale-en.js')}}" type="text/javascript"></script>
<script src="{{asset('packages/nifus/admin-panel/js/grid/js/jquery.jqGrid.min.js')}}" type="text/javascript"></script>


<script type="text/javascript">
    $(function(){
        var url         = '{{$builder->getJsonUrl()}}';
        var colNames    = {{$builder->getJsonColNames()}};
        var colModel    = {{$builder->getJsonColModel()}};
        var rowNum      = {{$builder->getRowNum()}};

        var options={
            url     : url,
            datatype: "json",
            jsonReader: {
                repeatitems : false,
                id: "0"
            },
            height:410,
            width:810,
            rowList: [10,20,30],
            pager: '#pgwidth',
            colNames:colNames,
            colModel:colModel,

            editurl: "server.php",
            viewrecords: true,
        }
        $("#table").jqGrid(options);
        $("#table").jqGrid('navGrid',"#pgwidth",{edit:true,add:false,del:false});
        $("#table").jqGrid('inlineNav',"#pgwidth");

    })



</script>

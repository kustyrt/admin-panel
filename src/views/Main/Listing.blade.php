<div class="page-head">
    <h2 class="pull-left"><i class="icon-table"></i> Tables</h2>

    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="icon-home"></i> Home</a>
        <span class="divider">/</span>
        <a href="#" class="bread-current">Dashboard</a>
    </div>

    <div class="clearfix"></div>

</div>


<div class="matter">
    <div class="container">


        <div class="row">

            <div class="col-md-12">

                <table id="table"></table>
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
        var data        = {{$builder->getJsonData()}};
        var rowNum      = {{$builder->getJsonRowNum()}};

        var options={
            url     : url,
            datatype: "json",
            jsonReader: {
                repeatitems : false,
                id: "0"
            },
            height:810,
            width:810,
            rowNum:10000,
            //datastr:data,
            colNames:colNames,
            colModel:colModel
        }

        /*if ( cols.length>2 ){
         options.width=table_width;
         options.shrinkToFit=false;
         }else{
         options.autowidth=true;
         }

         options.loadComplete=function(){
         $('a[data-type]').click(function(){
         var send_request=[];
         send_request.type = $(this).attr('data-type');
         send_request.period = $(this).attr('data-period');
         send_request.article = $(this).attr('data-article');
         send_request.category = $(this).attr('data-category');
         $('#detail_json').val( JSON.stringify(send_request) );
         })

         }*/

        $("#table").jqGrid(options);
    })



</script>

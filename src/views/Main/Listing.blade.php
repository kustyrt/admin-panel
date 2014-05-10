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
                </div>
            </div>

            <div class="col-md-12">
                <table id="table"></table>
                <div id="pgwidth"></div>
            </div>
        </div>
        <div id="edit_form"></div>

    </div>
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
        )
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
            //width:1050,
            autowidth: true,
            rowList: [10,20,30],
            pager: '#pgwidth',
            colNames:colNames,
            colModel:colModel

        }

        @if ( true===$builder->config('custom_edit') )
            options.onSelectRow = function(id){
                //alert(id)
                Ap.editRow(id);
                /*if(id && id!==lastsel2){
                    jQuery('#rowed5').jqGrid('restoreRow',lastsel2);
                    jQuery('#rowed5').jqGrid('editRow',id,true);
                    lastsel2=id;
                }*/
            };
            /*options.gridComplete= function(){

                var ids = $("#table").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"$('#table').editRow('"+cl+"');\"  />";
                    se = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"$('#table').saveRow('"+cl+"');\"  />";
                    ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=\"$('#table').restoreRow('"+cl+"');\" />";
                    $("#table").jqGrid('setRowData',ids[i],{act:be+se+ce});
                }
            };*/
            $("#table").jqGrid(options);
        @else
            @if (true==$builder->config('fast_edit') )
                options.editurl = "server.php";
                options.viewrecords = true;
                $("#table").jqGrid(options);

                $("#table").jqGrid('navGrid',"#pgwidth",{edit:true,add:false,del:false});
                $("#table").jqGrid('inlineNav',"#pgwidth");
            @endif
        @endif



    })



</script>

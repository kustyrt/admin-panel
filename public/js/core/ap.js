var Ap={
    filter : Array(),
    operation : Array(),

    editUrl:false,
    listingUrl:false,
    filterUrl:false,
    filterKey:false,
    editRowid: 0,
    editForm:false,
    init : function(){
        this.initEditButtons();
        this.initFilter();
    },

    initFilterListing:function(url,key){
        Ap.filterUrl = url;
        Ap.filterKey = key;
    },

    initFilter:function(){

        $('body').on('click','#filter_show_button',function(){
            var status = $(this).attr('data-status');
            if ( status!='on' ){
                $('#filter_table').removeClass('hide');
                $(this).attr('data-status','on');
            }else{
                $('#filter_table').addClass('hide');
                $(this).attr('data-status','off');
            }
        });
        $('body').on('click','#filter_button',function(){
            Ap.filterTable();
        });
    },

    initEditForm : function( config ){
        if ( config.url ){
            this.editUrl = config.url;
        }
        if ( config.id ){
            this.editRowid = config.id;
        }
        if ( config.form ){
            this.editForm = config.form;
        }
        if ( config.delete_url ){
            this.deleteUrl = config.delete_url;
        }
    },

    initEditButtons:function(){
        $('body').on('click','#edit_back_button',function(){
            $("#table").trigger("reloadGrid");
            $('#listing').show();
            $('#edit_form').hide();
        });
        $('body').on('click','#edit_refresh_button',function(){
            Ap.editRow(Ap.editRowid);
        });
        $('body').on('click','#edit_save_button',function(){
            Ap.editSaveForm();
        });
        $('body').on('click','#listing_add_button',function(){
            Ap.editRow(0);
        });
        $('body').on('click','#edit_del_button',function(){
            Ap.deleteRow(Ap.editRowid);
        });
    },

    deleteRow: function(id){
        $.ajax({
            type: "POST",
            url: this.deleteUrl,
            data: "id="+id,
            dataType: "json",
            success: function(answer){
                $("#table").trigger("reloadGrid");
                $('#listing').show();
                $('#edit_form').hide();
               // $('#edit_form').html(answer.content).show();
            }
        });
    },

    editSaveForm:function(){
        //console.log('#'+Ap.editForm)
        $('#'+Ap.editForm).submit();
    },

    editRow:function(id){
        this.editRowid = id;
        $('#listing').hide();
        $('#edit_form').hide();
        $.ajax({
            type: "POST",
            url: this.editUrl,
            data: "id="+id,
            dataType: "json",
            success: function(answer){
                if ( answer.msg ){
                    $('#message').html(answer.msg).show();
                }
                $('#edit_form').html(answer.content).show();
                $("body").trigger("load_edit_page", [ "id" ]);
            }
        });
    },

    initFilterForm:function(id_form,data ){
        var form = $('#'+id_form);
        if (form.length==0 ){
            return false;
        }

        form.on('change','select',function(){
            var name = $(this).attr('data-filter-name');
            if ( name == undefined ){
                name = $(this).attr('name');
            }
            Ap.filter[name] = $(this).val();
        });
        form.on('keyup','input[type=text]',function(){
            var name = $(this).attr('data-filter-name');
            var operation = $(this).attr('data-operation');
            if ( name = undefined ){
                name = $(this).attr('name');
            }
            Ap.filter[name] = $(this).val();

            if ( operation != undefined ){
                Ap.operation[name] = operation;
            }
        });

        $('#filter_reset_button').on('click',function(){
            Ap.filter = new Array();
            document.getElementById(form.attr('id')).reset();
            Ap.filterTable();
        });

        if ( data!=null ){
            for( i in  data ){
                var el = form.find('*[name="'+i+'"]');
                if ( el.length>0 ){
                    el.val(data[i]);
                    el.change();
                    $('#filter_table').removeClass('hide');
                    $('#filter_show_button').attr('data-status','on');
                }
            }
            $('#filter_button').click();
        }
    },

    filterTable:function(){
        var base_url = Ap.listingUrl;
            //  filter
        var url = [];
        for(i in Ap.filter ){
            url[url.length]='filter['+i+']' +'='+Ap.filter[i];
        }
        base_url  = base_url  + '?' + url.join('&');
            // operation
        var operation=[];
        for(i in Ap.operation ){
            operation[operation.length]='operation['+i+']' +'='+Ap.operation[i];
        }
        base_url  = base_url  + '&' + operation.join('&');
        $("#table").jqGrid('setGridParam',{url:base_url ,page:1}).trigger("reloadGrid");

    },

    filterLoad:function(id){
        window.location.href=Ap.filterUrl+'?filter['+Ap.filterKey+']='+id
    },





    initDataTable:function(config){
        Ap.listingUrl = config.url;

       // console.log(config.url);
        var options={
            url     : config.url,
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
            colNames:config.colNames,
            colModel:config.colModel,
            gridComplete: function(){
                if ( Ap.filterUrl ){
                    var ids = jQuery("#table").getDataIDs();
                    for(var i=0;i<ids.length;i++){
                        var cl = ids[i];
                        be = "<input  type='button' value='Смотреть' onclick=Ap.filterLoad("+cl+"); ></ids>";
                        jQuery("#table").setRowData(ids[i],{filter:be})
                    }
                }
            }
        }

        if ( config.custom_edit ){
            options.onSelectRow = function(id,flag,event){
                var source = $(event.target);
                if ( !source.is('button') ){
                    Ap.editRow(id);
                }

            };
            $("#table").jqGrid(options);
        }else{
            if ( config.fast_edit ){
                options.editurl = "server.php";
                options.viewrecords = true;
                $("#table").jqGrid(options);
                $("#table").jqGrid('navGrid',"#pgwidth",{edit:true,add:false,del:false});
                $("#table").jqGrid('inlineNav',"#pgwidth");
            }
        }
    }






};

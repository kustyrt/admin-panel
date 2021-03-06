var Ap={
    pages:Array(),
    actions:Array(),
    filter : Array(),
    operation : Array(),

    editUrl:false,
    listingUrl:false,
    filterUrl:false,
    filterKey:false,
    editRowid: 0,
    editForm:false,
    module:false,
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
        $('body').on('click','button[data-id=edit_back_button]',function(){
            $("#table").trigger("reloadGrid");
            $('#listing').show();
            $('#edit_form').hide();
        });
        $('body').on('click','button[data-id=edit_refresh_button]',function(){
            Ap.editRow(Ap.editRowid);
        });
        $('body').on('click','button[data-id=edit_save_button]',function(){
            Ap.editSaveForm();
        });
        $('body').on('click','button[data-id=listing_add_button]',function(){
            Ap.editRow(0);
        });
        $('body').on('click','button[data-id=edit_del_button]',function(){
            Ap.deleteRow(Ap.editRowid);
        });


        $('body').on('click','button[data-button-open]',function(){
            var datatype = $(this).attr('data-type');
            Ap.simplePageView(datatype);
        });

        $('body').on('click','button[data-type=exel]',function(){
            var base_url = Ap.exel_url;
            //  filter
            var url = [];
            for(i in Ap.filter ){
                url[url.length]='filter['+i+']' +'='+Ap.filter[i];
            }
            if ( url.length>0 ){
                base_url  = base_url  + '?' + url.join('&');
            }

            // operation
            var operation=[];
            for(i in Ap.operation ){
                operation[operation.length]='operation['+i+']' +'='+Ap.operation[i];
            }
            if ( operation.length>0 ){
                base_url  = base_url  + '&' + operation.join('&');
            }

            window.location.href = base_url

        });

    },

    deleteRow: function(id){
        $.ajax({
            type: "POST",
            url: this.deleteUrl,
            data: "id="+id,
            dataType: "json",
            success: function(answer){
                if ( answer.redirect ){
                    window.location.href=answer.redirect;
                }
                $("#table").trigger("reloadGrid");
                $('#listing').show();
                $('#edit_form').hide();
               // $('#edit_form').html(answer.content).show();
            }
        });
    },

    editSaveForm:function(){
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
               if ( answer.redirect ){
                   window.location.href=answer.redirect;
               }
                if ( answer.msg ){
                    $('#message').html(answer.msg).show();
                    $('#message').addClass('alert-success').removeClass('alert-danger');
                }else{
                    $('#message').html(answer.error).show();
                    $('#message').addClass('alert-danger').removeClass('alert-success');
                }
                $('#edit_form').html(answer.content).show();
                $("body").trigger("load_edit_page", [ "id" ]);
            },
            error:function(  jqXHR,  textStatus,  errorThrown ){
                alert(jqXHR.responseJSON.error.message);
                console.log(jqXHR.responseJSON);

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
        form.on('change','input',function(){
            var name = $(this).attr('data-filter-name');
            if ( name == undefined ){
                name = $(this).attr('name');
            }
            Ap.filter[name] = $(this).val();
        });
        form.on('keyup','input[type=text]',function(){
            var name = $(this).attr('data-filter-name');
            var operation = $(this).attr('data-operation');
            if ( name == undefined ){
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
        Ap.module = config.module;
        var base_url = Ap.listingUrl;
        Ap.exel_url = config.exel_url;
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

        Ap.actions = config.colActions;
        Ap.pages = config.colPages;


        // console.log(config.url);
        var options={
            url     : base_url,
            datatype: "json",
            /*jsonReader: {
                repeatitems : false,
                id: "0"
            },*/

            height:410,
            //width:1050,
            autowidth: true,

            pager: '#pgwidth',
            colNames:config.colNames,
            colModel:config.colModel,
            gridComplete: function(){
                    Ap.makeFilterButtonsInTable();
                    Ap.makeActionButtonsInTable();
                    Ap.makePagesButtonsInTable();
            }
        }

        if ( config.custom_edit ){
            options.onSelectRow = function(id,flag,event){
                var source = $(event.target);
                if ( !source.is('button') ){
                    Ap.editRow(id);
                }
            };
        }

        if ( config.mapping ){
            options.jsonReader =  {
                repeatitems : false,
                id: "0"
            }
            options.rowList= [10,20,30,50,100];
        }else{
            options.viewrecords= true;
            options.rowNum = 2000000000000;
        }
        $("#table").jqGrid(options);

    },
    makeFilterButtonsInTable:function(){
        var ids = $("#table").getDataIDs();
        for(var i=0;i<ids.length;i++){
            var cl = ids[i];
            if ( Ap.filterUrl ){
                var filter = "<input  type='button' value='Смотреть' onclick=Ap.filterLoad("+cl+"); ></ids>";
            }else{
                var filter = "";
            }
            $("#table").setRowData(ids[i],{filter:filter})
        }
    },


    makeActionButtonsInTable:function(){

        var ids = $("#table").getDataIDs();
        for( var i in Ap.actions ){
            var act = Ap.actions[i];
            for(var j in ids ){
                var action_title = $('#table').getCell(ids[j], act.name);
                var id = $('#table').getCell(ids[j], act.key);
                var button = "<input  type='button' value='"+action_title+"' onclick='Ap.actionExecute(\""+act.url+"\","+id+")' ></ids>";
                var config = {};
                config[act.name] = button;
                $("#table").setRowData(ids[j],config)
            }
        }
    },

    makePagesButtonsInTable:function(){
        if ( Ap.pages==undefined ){
            return false;
        }
        var ids = $("#table").getDataIDs();
        for( var i in Ap.pages ){
            var act = Ap.pages[i];
            for(var j in ids ){
                var action_title = $('#table').getCell(ids[j], act.name);
                var id = $('#table').getCell(ids[j], act.key);
                var button = "<input  type='button' value='"+action_title+"' onclick='Ap.pageView(\""+act.name+"\","+id+")' ></ids>";
                var config = {};
                config[act.name] = button;
                $("#table").setRowData(ids[j],config)
            }
        }
    },

    actionExecute:function(url,id){
        $.ajax({
            type: "POST",
            url: url,
            data: "id="+id,
            dataType: "json",
            success: function(answer){
                if ( answer.redirect ){
                    window.location.href=answer.redirect;
                }
                $("#table").trigger("reloadGrid");
            }
        });
    },

    pageView:function(name,id){
        $.ajax({
            type: "POST",
            url: '/admin/page/'+Ap.module,
            data: "id="+id+"&name="+name,
            dataType: "json",
            success: function(answer){
                if ( answer.redirect ){
                    window.location.href=answer.redirect;
                }
                $('#listing').hide();
                $('#edit_form').show().html(answer.content);
                $("body").trigger("ap_load_page", [ "id" ]);
            }
        });
    },
    simplePageView:function(name){
        $.ajax({
            type: "POST",
            url: '/admin/simple_page/'+Ap.module,
            data: "name="+name,
            dataType: "json",
            success: function(answer){
                if ( answer.redirect ){
                    window.location.href=answer.redirect;
                }
                $('#listing').hide();
                $('#edit_form').show().html(answer.content);
            }
        });
    }


};


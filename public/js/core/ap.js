var Ap={
    editUrl:false,
    editRowid: 0,
    editForm:false,
    init : function(){
        this.initEditButtons();
        this.initFilter();
    },

    initFilter:function(){
        $('body').on('click','#filter_button',function(){
            var status = $(this).attr('data-status');
            if ( status!='on' ){
                $('#filter_table').removeClass('hide');
                $(this).attr('data-status','on');
            }else{
                $('#filter_table').addClass('hide');
                $(this).attr('data-status','off');
            }
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
        Ap.showPleaseWait();
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


        showPleaseWait: function() {
            var pleaseWaitDiv = $('<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>')
            pleaseWaitDiv.modal();
        },
        hidePleaseWait: function () {

            pleaseWaitDiv.modal('hide');
        }


};

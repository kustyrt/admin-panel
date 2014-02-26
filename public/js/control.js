$(document).ready(function(){
    $('*').keydown(function(event){

        if (event.which == 13 && event.ctrlKey) {

            WINDOWS.open('/development')
        };
    });

})


WINDOWS = {

        'onLoad':false,
        'onClose':false,
        'wtitle':false,

       

        /**
         * Полный аналог open, более расширенный
         *
         **/
        'create' :function(o)
        {
            WINDOWS.onload = WINDOWS.onclose = false;


            WINDOWS._lock()

            if ( o['onload'] )
            {
                WINDOWS.onload =  o['onload'];
            }
            if ( o['onclose'] )
            {
                WINDOWS.onclose =  o['onclose'];
            }
            //  запрос
            $.ajax( {
                'dataType':'html',
                'url': o['server'],
                'success': function(json){

                    WINDOWS.close();
                    // WINDOWS.onload = tmp.onload;
                    //WINDOWS.onclose = tmp.onclose;
                    alert(json)
                    //WINDOWS.show( res['title'],res['content']);
                },
                'error' : function(event, jqXHR, ajaxSettings) {
                    alert(ajaxSettings)
                }
            });
        },

        /**
         * Загружаем окно
         *
         */
        'open' : function(server){

            // tmp = {'onload':WINDOWS.onload,'onclose':WINDOWS.onclose};

            WINDOWS.onload = WINDOWS.onclose = false;

            WINDOWS._lock()
            //  запрос
            $.ajax( {
                'dataType':'html',
                'url': server,
                'success': function(json){

                    WINDOWS.close();
                    // WINDOWS.onload = tmp.onload;
                    //WINDOWS.onclose = tmp.onclose;
                    //res = App.get('system').executeResult( xml );
                    WINDOWS.show( '',json);

                },
                'error' : function(event, jqXHR, ajaxSettings) {
                    alert(ajaxSettings)
                }
            });


        },

        'show' : function(title,content)
        {

            WINDOWS._background = false;
            if ( $('#wnd_modal').size()>0 ){
                WINDOWS.close();
            }
            if ( $('#wnd_background').size()>0 ){
                $('#wnd_background').css('display', 'block' );
            }else{
                WINDOWS.background = $('<div/>').attr('id','wnd_background').attr('class','windows_background').appendTo( document.body );

                //    временно кривое решение для перехвата клавиш
                //WINDOWS.onkeydown = function(e){ wnd.keydown(e) };
            }
            WINDOWS.$ = $('<div/>').attr('id','wnd_modal').attr('class','windows_body').appendTo( document.body );
            WINDOWS.wtitle=title;
            WINDOWS.wcontent = content;

            WINDOWS._rematch()
            if (  WINDOWS.onload ){
                WINDOWS.onload();
                WINDOWS.onload =false;
            }

        },

        //  закрываем модальное окно
        'close' : function()
        {
            if( $('#wnd_modal').size()>0 ){ $('#wnd_modal').remove()}

            if( $('#wnd_background').size()>0 ){ $('#wnd_background').remove()}

            if ( this.onclose ){
                this.onclose();
                this.onclose =false;
            }
            return false;
        },

        //  идёт загрузка
        '_lock' : function()
        {

        },

        '_rematch' : function()
        {
            html = '';


            this.$.html( $(this.wcontent));
        }


}
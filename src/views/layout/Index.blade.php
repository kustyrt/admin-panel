<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Административная панель</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">


  <link href="{{asset('packages/nifus/admin-panel/style/bootstrap.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/font-awesome.css')}}">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/fullcalendar.css')}}">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/prettyPhoto.css')}}">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/rateit.css')}}">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/bootstrap-datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/jquery.cleditor.css')}}">
  <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/bootstrap-switch.css')}}">
  <link href="{{asset('packages/nifus/admin-panel/style/style.css')}}" rel="stylesheet">
  <link href="{{asset('packages/nifus/admin-panel/style/widgets.css')}}" rel="stylesheet">
  <script src="{{asset('packages/nifus/admin-panel/js/jquery.js')}}"></script>
  <script src="{{asset('packages/nifus/admin-panel/js/core/ap.js')}}"></script>
    <link href="{{asset('packages/nifus/admin-panel/style/yamm.css')}}" rel="stylesheet">



  <!--[if lt IE 9]>
  <script src="{{asset('packages/nifus/admin-panel/js/html5shim.js')}}"></script>
  <![endif]-->

  <link rel="shortcut icon" href="{{asset('packages/nifus/admin-panel/img/favicon/favicon.png')}}">
</head>

<body>

<nav class="navbar navbar-fixed-top bs-docs-nav yamm navbar-default " role="banner">




            <div class="col-md-3">
                <div class="logo">
                    <h1><a href="{{route('ap.main')}}">{{$builder->config('name')}}</a></h1>
                </div>
            </div>
            {{$menu_left}}

            {{$user_menu}}

  </nav>






<div class="content">


    <!-- Main bar -->
    <div class="mainbar">
    {{$content}}
    </div>

   <div class="clearfix"></div>

</div>


<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 


<script src="{{asset('packages/nifus/admin-panel/js/bootstrap.js')}}"></script> <!-- Bootstrap -->
<script src="{{asset('packages/nifus/admin-panel/js/jquery-ui-1.9.2.custom.min.js')}}"></script> <!-- jQuery UI -->
<script src="{{asset('packages/nifus/admin-panel/js/fullcalendar.min.js')}}"></script> <!-- Full Google Calendar - Calendar -->
<script src="{{asset('packages/nifus/admin-panel/js/jquery.rateit.min.js')}}"></script> <!-- RateIt - Star rating -->
<script src="{{asset('packages/nifus/admin-panel/js/jquery.prettyPhoto.js')}}"></script> <!-- prettyPhoto -->

<script src="{{asset('packages/nifus/admin-panel/js/excanvas.min.js')}}"></script>
<script src="{{asset('packages/nifus/admin-panel/js/jquery.flot.js')}}"></script>
<script src="{{asset('packages/nifus/admin-panel/js/jquery.flot.resize.js')}}"></script>
<script src="{{asset('packages/nifus/admin-panel/js/jquery.flot.pie.js')}}"></script>
<script src="{{asset('packages/nifus/admin-panel/js/jquery.flot.stack.js')}}"></script>

<script src="{{asset('packages/nifus/admin-panel/js/jquery.noty.js')}}"></script> <!-- jQuery Notify -->
<script src="{{asset('packages/nifus/admin-panel/js/themes/default.js')}}"></script> <!-- jQuery Notify -->
<script src="{{asset('packages/nifus/admin-panel/js/layouts/bottom.js')}}"></script> <!-- jQuery Notify -->
<script src="{{asset('packages/nifus/admin-panel/js/layouts/topRight.js')}}"></script> <!-- jQuery Notify -->
<script src="{{asset('packages/nifus/admin-panel/js/layouts/top.js')}}"></script> <!-- jQuery Notify -->

<script src="{{asset('packages/nifus/admin-panel/js/sparklines.js')}}"></script> <!-- Sparklines -->
<script src="{{asset('packages/nifus/admin-panel/js/jquery.cleditor.min.js')}}"></script> <!-- CLEditor -->
<script src="{{asset('packages/nifus/admin-panel/js/bootstrap-datetimepicker.min.js')}}"></script> <!-- Date picker -->
<script src="{{asset('packages/nifus/admin-panel/js/bootstrap-switch.min.js')}}"></script> <!-- Bootstrap Toggle -->
<script src="{{asset('packages/nifus/admin-panel/js/filter.js')}}"></script> <!-- Filter for support page -->
<script src="{{asset('packages/nifus/admin-panel/js/custom.js')}}"></script> <!-- Custom codes -->
<script src="{{asset('packages/nifus/admin-panel/js/charts.js')}}"></script> <!-- Charts & Graphs -->
    {{$js}}

    <script type="text/javascript">
        $(document).on('click', '.yamm .dropdown-menu', function(e) {
            e.stopPropagation()
        })
    </script>
</body>
</html>
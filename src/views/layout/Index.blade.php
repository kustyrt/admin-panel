<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Административная панель</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="{{asset('packages/nifus/admin-panel/style/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('packages/nifus/admin-panel/style/font-awesome.css')}}">
    <link href="{{asset('packages/nifus/admin-panel/style/style.css')}}" rel="stylesheet">

    <script src="{{asset('packages/nifus/admin-panel/js/jquery.js')}}"></script>
    <script src="{{asset('packages/nifus/admin-panel/js/bootstrap.js')}}"></script>
    <script src="{{asset('packages/nifus/admin-panel/js/core/ap.js')}}"></script>


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




{{$js}}

<script type="text/javascript">
    $(document).on('click', '.yamm .dropdown-menu', function (e) {
        e.stopPropagation()
    })
</script>
</body>
</html>
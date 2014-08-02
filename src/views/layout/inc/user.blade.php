<ul class="nav navbar-nav pull-right">
    <li class="dropdown pull-right">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="icon-user"></i> {{$user->username}} <b class="caret"></b>
        </a>

        <ul class="dropdown-menu">
            <li><a href="{{ route('ap.logout') }}"><i class="icon-off"></i> {{ trans('admin-panel::admin.exit') }}</a></li>
        </ul>
    </li>

</ul>
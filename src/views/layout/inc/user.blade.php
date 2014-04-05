<ul class="nav navbar-nav pull-right">
    <li class="dropdown pull-right">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="icon-user"></i> {{$user->username}} <b class="caret"></b>
        </a>

        <!-- Dropdown menu -->
        <ul class="dropdown-menu">
            <!--<li><a href="#"><i class="icon-user"></i> Профиль</a></li>
            <li><a href="#"><i class="icon-cogs"></i> Settings</a></li>-->
            <li><a href="{{ route('ap.logout') }}"><i class="icon-off"></i> Выход</a></li>
        </ul>
    </li>

</ul>
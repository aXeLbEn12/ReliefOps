<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="http://119.81.51.170/dashboard/assets/default/img/ReliefOps-icon_small.png" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Juan Dela Cruz</strong>
                         </span> <span class="text-muted text-xs block">INCIDENT MANAGER <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">REPORTS</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/reports/list') }}">Report List</a></li>
                    <li><a href="{{ url('/reports/new') }}">Report Upload</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-th"></i> <span class="nav-label">CONFIGURATION</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/configuration') }}">Configuration List</a></li>
                    <li><a href="{{ url('/configuration/new') }}">Add</a></li>
                </ul>
            </li>
            <!--<li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">PREPAREDNESS RESPONSE</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/preparedness_response/list') }}">Report List</a></li>
                    <li><a href="{{ url('/preparedness_response/new') }}">Report Upload</a></li>
                </ul>
            </li>-->


        </ul>
    </div>
</nav>
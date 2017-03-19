<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            @if(strlen($user->avatar) > 0)
                            <img alt="image" class="img-circle" src="{{ asset('images/profilepix/'.$user->avatar) }}" width="50px" />
                             
                            @else
                            <img alt="image" class="img-circle" src="{{ asset('images/profilepix/avatar.jpg') }}" width="50px" />
                            @endif
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $user->name }}</strong>
                             </span> <span class="text-muted text-xs block"><b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{ url('profile') }}">My Profile</a></li>
                            <li><a href="{{ url('change/password') }}">Change Password</a></li>
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li>
                    <a href="{{ url('dashboard') }}"><i class="fa fa-laptop"></i> 
                    <span class="nav-label">Dashboard</span> </a>
                </li>
                <li>
                    <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span> <span class="label label-primary pull-right">NEW</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-credit-card"></i> 
                    <span class="nav-label">Provide Help</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('new/donation') }}">New Donation</a></li>
                        <li><a href="graph_flot.html">Make Payment</a></li>
                        <li><a href="{{ url('all/ph/payments') }}">All Payments</a></li>
                        <li><a href="{{ url('ph/transactions') }}">Transaction History</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-money"></i> 
                    <span class="nav-label">Get Help</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('new/request') }}">Request Payment</a></li>
                        <li><a href="graph_flot.html">Confirm Payment Received</a></li>
                        <li><a href="graph_flot.html">Transaction History</a></li>
                    </ul>
                </li>

                @role(['admin', 'superadmin'])
                    <!-- this part is the admin link -->
                 <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Admin</span>
                    <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('users') }}">Users</a></li>
                        <li><a href="{{ url('admin/phorders') }}">PH Orders 
                            <span class="label label-info pull-right">62</span></a> 
                        </li>
                        <li><a href="{{ url('admin/ghorders') }}">GH Orders</a></li>
                    </ul>
                </li>

                 <li>
                    <a href="{{ url('announcements/create') }}"><i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Create Announcement</span></a>
                </li>
                @endrole
                <li>
                <a href="{{ url('announcements') }}"><i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Announcement</span></a>

                <li>
                    <a href="#"><i class="fa fa-quote-left"></i>
                    <span class="nav-label">View Testimonies</span></a>
                </li>
               
                 <li>
                    <a href="#"><i class="fa fa-question-circle"></i>
                    <span class="nav-label">FAQ</span></a>
                </li>
                              
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>

                            </ul>
                        </li>
                        <li><a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
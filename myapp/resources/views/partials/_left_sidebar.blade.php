<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                        <span class="sidebar_img">
                            @if(strlen($user->avatar) > 0)
                            <img alt="image" class="img-circle" 
                                src="{{ asset('images/profilepix/'.$user->avatar) }}"
                                 width="50px" height="50px" />
                             
                            @else
                            <img alt="image" class="img-circle" src="{{ asset('images/profilepix/avatar.jpg') }}"
                             width="50px" height="50px" />
                            @endif
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle sidebar_name" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $user->name }}</strong>
                             </span></a>
                       <!--  <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{ url('profile') }}">My Profile</a></li>
                            <li><a href="{{ url('change/password') }}">Change Password</a></li>
                        </ul> -->
                    </div>
                    <div class="logo-element">
                        
                    </div>
                </li>
                <li>
                    <a href="{{ url('dashboard') }}"><i class="fa fa-laptop"></i> 
                    <span class="nav-label">Dashboard</span> </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user-plus"></i> 
                    <span class="nav-label">Referrals</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('manage/referral') }}">Manage Referrals</a></li>
                        <li><a href="{{ url('referral') }}">Referrals</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-credit-card"></i> 
                    <span class="nav-label">Provide Help</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('new/donation') }}">New Donation</a></li>
                        <li><a href="{{ url('ph/make/payments') }}">Make Payment</a></li>
                        <li><a href="{{ url('all/ph/payments') }}">All Payments</a></li>
                        <li><a href="{{ url('ph/transactions') }}">Transaction History</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-money"></i> 
                    <span class="nav-label">Get Help</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('new/request') }}">Request Payment</a></li>
                        <li><a href="{{ url('confirm/gh/payment') }}">Confirm Payment Received</a></li>
                        <li><a href="{{ url('confirm/gh/payment/history') }}">Payment History</a></li>
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
                        <li><a href="{{ url('admin/fakepop') }}">Fake Pop</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Announcement</span>
                    <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('announcements/create') }}">Create Announcement</a></li>
                        <li><a href="{{ url('announcements/view') }}">View Announcements</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-envelope"></i> 
                    <span class="nav-label">Messages</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('admin/messaging/compose') }}">Compose</a></li>
                        <li><a href="{{ url('admin/messaging/inbox') }}">Inbox</a></li>
                        <li><a href="{{ url('admin/messaging/outbox') }}">Outbox</a></li>
                    </ul>
                </li>
                @endrole
                @role(['users'])
                <li>
                    <a href="#"><i class="fa fa-envelope"></i> 
                    <span class="nav-label">Messages</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('messaging/compose') }}">Compose</a></li>
                        <li><a href="{{ url('messaging/inbox') }}">Inbox</a></li>
                        <li><a href="{{ url('messaging/outbox') }}">Outbox</a></li>
                    </ul>
                </li>
                @endrole
                <li>
                    <a href="{{ url('announcements') }}"><i class="fa fa-newspaper-o"></i>
                        <span class="nav-label">Announcement</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-quote-left"></i>
                    <span class="nav-label">View Testimonies</span></a>
                </li>
               
                <li>
                    <a href="#"><i class="fa fa-question-circle"></i>
                    <span class="nav-label">FAQ</span></a>
                </li>
                <li>
                    <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>
                        <span class="nav-label">Logout</span></a></li>
                </li>
            </ul>

        </div>
    </nav>
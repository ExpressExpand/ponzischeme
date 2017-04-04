<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">
                            {{ $messages->count() }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        @foreach($messages as $message)
                        <li>
                            <!-- <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div> -->
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">
                                        {{ $message->created_at->diffForHumans() }}</small>
                                    {{ getExcerpt($message->subject,50) }}
                                    <strong> - Admin</strong>. <br>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <img src="{{ asset('images/app/avatar.jpg') }}" 
                            alt="users picture" class="img-circle" width="30px" height="30px">
                            <span>{{ $user->name }}</span>
                    </a>
                    <ul class="dropdown-menu top-user-menu">
                        <li>
                            <div class="dropdown-messages-box">
                                <div class="media-body">
                                    <a href="{{ url('profile') }}">
                                        My Profile
                                    </a>
                                </div>               
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-messages-box">
                                <div class="media-body">
                                    <a href="{{ url('change/password') }}">
                                        Change Password
                                    </a>
                                </div>               
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-messages-box">
                                <div class="media-body">
                                    <a href="{{ url('logout') }}">
                                       Log out
                                    </a>
                                </div>               
                            </div>
                        </li>                        
                    </ul>
                </li>
            </ul>

        </nav>
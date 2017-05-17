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
                        @foreach($messages as $message)
                            <div class="dropdown-messages-box custom-block">
                                <a href="profile.html" class="pull-left">
                                    <img src="{{ asset('images/app/avatar.jpg') }}" 
                                    alt="users picture" class="img-circle" width="100%">
                                </a>
                                <div class="media-body clearfix">
                                    <small class="pull-right">
                                        {{ $message->created_at->diffForHumans() }}</small>
                                    {{ getExcerpt($message->message->subject,50) }}
                                    <strong> - Admin</strong>. <br>
                                    <!-- <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small> -->
                                </div>
                            </div><br />
                        @endforeach
                        </li>
                        <li class="divider"></li>
                        <li>
                            @role('users')
                            <div class="text-center link-block">
                                <a href="{{ url('messaging/inbox') }}">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                            @endrole
                            @role(['admin', 'superadmin'])
                            <div class="text-center link-block">
                                <a href="{{ url('admin/messaging/inbox') }}">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                            @endrole
                        </li>
                    </ul>
                </li>
               
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                             @if(strlen($user->avatar) > 0)
                            <img alt="avatar" class="img-circle" 
                                src="{{ asset('images/profilepix/'.$user->avatar) }}"
                                 width="30px" height="30px" />
                             
                            @else
                            <img alt="avatar" class="img-circle" src="{{ asset('images/profilepix/avatar.jpg') }}"
                             width="30px" height="30px" />
                            @endif
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
@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>All Users</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">This is</a>
                </li>
                <li class="active">
                    <strong>Breadcrumb</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <!-- <a href="#" class="btn btn-primary">This is action area</a> -->
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">TOTAL</span>
                                <h5>USERS</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $users_count }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">ACTIVE</span>
                                <h5>ACTIVE USERS</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $active_count }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">INACTIVE</span>
                                <h5>BLOCKED USERS</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $inactive_count }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    @include('partials/_alert')
                    {{ Form::open(['url' => 'admin/change/role', 'method' => 'post']) }}
                    <div class="row">
                        <div class="col-sm-offset-4 col-sm-3">
                            {{ Form::select('change_role', $roles, null, ['required'
                            , 'placeholder' => 'Select', 'class' => '']) }}
                            <button type="submit" class="btn btn-default">Change Role</button>
                        
                        </div>
                    </div> 
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME </th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>POINTS</th>
                        <th>STATUS</th>
                        <th>DATE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users)
                    <?php $count = 0; ?>
                    @foreach ($users as $user)
                    @if($user->hasRole('superadmin'))
                        <?php continue; ?>
                    @endif
                    <tr>
                       <td>{{ ++$count }}</td> 
                       <td class="clearfix">
                       <a href="{{ url('admin/user/profile', $user->id) }}"> {{ $user->name }}</a>
                        <span class="pull-right">
                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                        </span></td> 
                       <td>{{ $user->email }}</td> 
                       <td>
                            <?php $roles = array();
                               foreach($user->roles as $role) {
                                 $roles[] = $role->display_name; 
                               }
                               echo implode(',', $roles); ?>
                       </td> 
                       <td>{{ $user->points }}</td> 
                       <td>
                       @if($user->isBlocked == 0)
                           <label class="label label-primary">Active</label>
                            <a href="{{ url('admin/block/user', $user->id) }}" 
                            class="btn btn-primary btn-sm">Block</a>
                       @else
                            <label class="label label-danger">Inactive</label>
                            <a href="{{ url('admin/unblock/user', $user->id) }}" 
                            class="btn btn-danger btn-sm">Unblock</a>
                       @endif
                       </td> 
                       <td>{{ date('M d, Y h:i:sa', strtotime($user->created_at)) }}</td> 
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="8"><center>No Data Available</center></th>
                        </tr>
                    @endif
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>NAME </th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>POINTS</th>
                        <th>STATUS</th>
                        <th>DATE</th>
                    </tr>
                    </tfoot>
                    </table>
                    <div><span class="paginate">{{ $users->render() }}</span></div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')
<!-- Data Tables -->
<script src="{{ asset('js/inspinia/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/inspinia/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.dataTables-example').dataTable({
            responsive: true,
        });
    });
</script>
@stop
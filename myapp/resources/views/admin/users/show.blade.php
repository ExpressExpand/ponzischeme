@extends('layouts/master')
@section('title', 'Profile Management')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>My Profile</h2>
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
                @if($user->isBlocked == 0)
                    <a href="{{ url('admin/block/user', $user->id) }}" 
                    class="btn btn-primary btn-sm">Block User</a>
               @else
                    <a href="{{ url('admin/unblock/user', $user->id) }}" 
                    class="btn btn-danger btn-sm">Unblock User</a>
               @endif
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <center><h2>{{ ucwords($user->name) }}</h2></center>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                {!! Form::open( ['url' => 'profile/change/picture', 'method' => 'put', 'role' => 'form', 'file' => 'true', 'id' => 'avatar-form', 
                                'enctype' => 'multipart/form-data']) !!}
                                    <div class="avatar-holder">
                                        @if(strlen($user->avatar))
                                        <img src="{{ asset('images/profilepix/'.$user->avatar) }}" 
                                        alt="users picture" class="img-thumbnail" width="100%">
                                    @else 
                                        <img src="{{ asset('images/app/avatar.jpg') }}" 
                                        alt="users picture" class="img-thumbnail" width="100%">
                                    @endif
                                        
                                    </div>
                                   
                                {!! Form::close() !!}
                            </div>
                            <div>
                               <!--  google ads  -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                                @include('partials/_alert')
                            <div class="row profile-group clearfix">
                                <div class="col-sm-3 key"><span>Email: </span></div>
                                <div class="col-sm-9 data">
                                    @if($user->isVerified == 1)
                                        <span class="green">{{ $user->email}} </span>
                                        <span class="pull-right green" >
                                        <i class="fa fa-check"></i> Verified</span>
                                    @else
                                        <span class="error">{{ $user->email}} 
                                        <a class="pull-right error" href="{{ url('verify/email') }}">
                                          <i class="fa fa-exclamation-triangle"></i> Verify</a></span>
                                    @endif
                                </div>
                            </div>
                            <div class="row profile-group">
                                <div class="col-sm-3 key">Phone: </div>
                                <div class="col-sm-9 data">{{ $user->phone}}</div>
                            </div>
                            <div class="row profile-group">
                                <div class="col-sm-3 key">Country: </div>
                                <div class="col-sm-9 data">{{ $user->country->name}}</div>
                            </div>
                            <div class="row profile-group">
                                <div class="col-sm-3 key">Referral Username: </div>
                                <div class="col-sm-9 data">
                                    {{ Form::model($user, ['url' => 'profile/change/username'
                                    , 'method' => 'put',
                                    'class' => 'form-horizontal']) }}

                                    {{ Form::text('referrerUsername', null, ['class' => '', 'required']) }}
                                   
                                    
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <h3>Account Information</h3><hr />
                            <?php 
                                if(strlen($user->bankName) == 0 ) {
                                    $readonly =  '';
                                }else {
                                    $readonly = 'readonly';
                                }
                            ?>
                            {{ Form::model($user, ['url' => 'profile/store', 'method' => 'put',
                             'class' => 'form-horizontal']) }}
                                @if(!strlen($user->bankName))
                                <div class="alert alert-warning"> 
                                    You have to contact admin to be able to change your bank details.</div>
                                @else
                                <div class="alert alert-warning"> 
                                    Once the bank details changed, you cannot edit it 
                                    unless you contact admin.</div>
                                @endif
                                <div class="form-group">
                                    <label for="bankName" class="col-sm-3 control-label">Bank Name: </label>
                                    <div class="col-sm-9">
                                    {{ Form::text('bankName', null, ['class' => 'form-control', 'required'
                                    , $readonly]) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="accountName" class="col-sm-3 control-label">Account Name:</label>
                                    <div class="col-sm-9">
                                    {{ Form::text('accountName', null, ['class' => 'form-control', 'required',
                                     $readonly]) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="accountNumber" class="col-sm-3 control-label">Account Number:</label>
                                    <div class="col-sm-9">
                                    {{ Form::text('accountNumber', null, ['class' => 'form-control',
                                     'required',  $readonly]) }}
                                    </div>
                                </div>
                            <h2>Change User Password</h2><hr>
                            {{ Form::close() }}
                            <div class="row">
                            {{ Form::model($user, ['method' => 'patch',
                             'url' => ['admin/change/password/store', $user->id],
                              'role' => 'form', 'files' => true, 'class'=> 'form-horizontal', 'id' => 'userpasswordupdate']) }}
                                
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="bankName">Password: 
                                  <span class="error">*</span></label>
                                  <div class="col-sm-6">
                                    {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'required']) }}
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="accountNumber">Confirm Password:
                                   <span class="error">*</span></label>
                                  <div class="col-sm-6">
                                    {{ Form::password('confirmPassword', 
                                    ['id' => 'confirmPassword', 'class' => 'form-control', 'required']) }}
                                  </div>
                                </div>
                                <div class="form-group"> 
                                  <div class="col-sm-offset-3 col-sm-7">
                                    <button type="submit" 
                                    class="btn btn-primary" id="userpasswordupdateBtn">
                                    <i class="fa fa-save"></i> Save Changes</button>
                                  </div>
                                </div>
                              {{ Form::close() }}
                              </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- google ads -->
                            @include('partials/_google_ads')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')

@stop
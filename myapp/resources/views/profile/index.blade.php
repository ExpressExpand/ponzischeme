@extends('layouts/master')
@section('title', 'Profile Management')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>My Profile</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{ url('profile') }}">Profile</a>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <!-- <a href="#" class="btn btn-primary">My Profile</a> -->
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
                                        <div class="progressBar">
                                            <div class="bar"></div>
                                            <div class="percent">0%</div>
                                        </div>
                                    </div>
                                    <div class="image-change">
                                        <span>Change Photo</span>
                                        <input type="file" name="avatar" id="avatar-input">
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
                                    <span> {{ Form::submit('Change', ['class' => '']) }}</span>
                                    
                                    {{ Form::close() }}
                                </div>
                            </div>
                             <div class="row profile-group">
                                <div class="col-sm-3 key">Bitcoin: </div>
                                <div class="col-sm-9 data">
                                    {{ Form::model($user, ['url' => 'profile/bitcoin/store'
                                    , 'method' => 'put',
                                    'class' => 'form-horizontal']) }}

                                    {{ Form::text('bitcoinAddress', null, ['class' => '', 'required']) }}
                                    <span> {{ Form::submit('Submit', ['class' => '']) }}</span>
                                    
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
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        @if(strlen($user->bankName) == 0) 
                                            {{Form::submit('Save changes', ['class'=> 'btn btn-primary'])}}
                                        @endif
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-3">
                            <div class="points">
                                <?php 
                                    $color = App\Http\Helpers\ApplicationHelpers::getPointColor($user->points); 

                                ?>
                                <div class="user_points" style="background-color: {{$color}}">{{ $user->points }} points 
                                </div>
                            </div>
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
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script>
        $(document).on('change', '#avatar-input', function () {
        var progressBar = $('.progressBar');
        var bar = $('.progressBar .bar');
        var percent = $('.progressBar .percent');

            $('#avatar-form').ajaxForm({
                beforeSend: function() {
                    progressBar.fadeIn();
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                success: function(html, statusText, xhr, $form) {       
                    if(html.msg){       
                        var percentVal = '100%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        console.log(html.msg);
                        var src = '/images/profilepix/'+html.msg;
                        $(".avatar-holder>img").prop('src', src);           
                    }else{
                        alert(html.error);
                    }
                },
                complete: function(xhr) {
                    progressBar.fadeOut();          
                }   
            }).submit();        

        });
    </script>
@stop
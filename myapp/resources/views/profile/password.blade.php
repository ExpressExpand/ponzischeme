@extends('layouts/master')
@section('title', 'Provide help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>This is main title</h2>
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
                <a href="#" class="btn btn-primary">This is action area</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content">
                    @include('partials/_alert')
                     {{ Form::model($user, ['method' => 'patch',
                     'url' => ['change/password/store', $user->id],
                      'role' => 'form', 'files' => true, 'class'=> 'form-horizontal', 'id' => 'userpasswordupdate']) }}
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="bankName">Old Password: 
                          <span class="error">*</span></label>
                          <div class="col-sm-6">
                            {{ Form::password('old_password', ['id' => 'old_password',
                             'class' => 'form-control', 'required']) }}
                          </div>
                        </div>

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
        </div>
    </div>        
@stop
@section('resources')

@stop
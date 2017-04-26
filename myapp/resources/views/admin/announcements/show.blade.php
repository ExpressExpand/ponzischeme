@extends('layouts/master')
@section('title', 'Provide help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Announcements.</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Announcement</strong>
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
                <div class="ibox-content">
                    @include('partials/_alert')
                    @if($announcement)
                    <p>
                        {!! $announcement->message !!}
                    </p>
                    @else
                    <p><h3>There are no recent announcements</h3></p>
                    @endif
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')

@stop
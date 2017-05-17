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
                    {{ Form::open(['url' => 'announcements', 'class'=>'form-horizontal', 'method'=>'post']) }}
                        
                        <div class="form-group">
                            <div class="col-lg-12">
                                {{ Form::textarea('message', null, ['class' => 'form-control',
                                 'required', 'id' => 'editor', 'rows' => '20']) }}
                            </div>
                        </div>                       
                        <div class="form-group">
                            <div class=" col-lg-10">
                                <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-paper-plane"></i> Submit</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>        
@stop
@section('resources')
<script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.replace( 'editor', {
     filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>
@stop
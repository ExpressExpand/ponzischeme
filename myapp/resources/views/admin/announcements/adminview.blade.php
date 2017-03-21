@extends('layouts/master')
@section('title', 'Ph orders')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Announcements</h2>
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
                <a href="#" class="btn btn-primary">This is action area</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content">
                    @include('partials/_alert')
                                      
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Message </th>
                        <th>Author</th>
                        <th>DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($announcements)
                    <?php $count = 0; ?>
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td> {{ ++$count }}</td>
                            <td>{{ getExcerpt($announcement->message, 150) }}</td>
                            <td>{{ $announcement->author->name }}</td>
                            <td>{{ date('M d, Y', strtotime($announcement->created_at)) }}</td>
                            <td>
                                 {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['announcements', $announcement->id],
                                    'id' => $announcement->id, 
                                ]) !!}
                                <a href="{{ url('announcements/'. $announcement->id.'/edit')}}" class="btn btn-info">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                 <a href="#" class="btn btn-danger" 
                                 onclick="document.getElementById({{ $announcement->id }}).submit()">
                                <i class="fa fa-trash"></i> Delete</a>
                                
                                <noscript>
                                  <input type="submit" value="Submit form!" />
                                </noscript>
                                {{  Form::close() }}
                            </td>
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
                        <th>Message </th>
                        <th>Author</th>
                        <th>DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                    </tfoot>
                    </table>
                    <div><span class="paginate">{{ $announcements->render() }}</span></div>
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
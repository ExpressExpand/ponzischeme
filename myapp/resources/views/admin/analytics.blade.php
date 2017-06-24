@extends('layouts/master')
@section('title', 'Analytics')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Analytics</h2>
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
              
                <div class="ibox-content">
                    @include('partials/_alert')                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>IP </th>
                        <th>COUNTRY</th>
                        <th>CODE</th>
                        <th>CITY</th>
                        <th>PATH</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                        <th>DATE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($analytics)
                        @foreach($analytics as $analytic)
                        <tr>
                           <td>{{ (isset($analytic->ip)) ? $analytic->ip : '' }}</td>
                           <td>{{ (isset($analytic->country)) ? $analytic->country : '' }}</td>
                           <td>{{ (isset($analytic->code)) ? $analytic->code : '' }}</td>
                           <td>{{ (isset($analytic->city)) ? $analytic->city : '' }}</td>
                           <td>{{ (isset($analytic->path)) ? $analytic->path : '' }}</td>
                           <td>{{ (isset($analytic->latitude)) ? $analytic->latitude : '' }}</td>
                           <td>{{ (isset($analytic->longitude)) ? $analytic->longitude : '' }}</td>
                           <td>{{ $analytic->created_at }}</td>
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
                        <th>IP </th>
                        <th>COUNTRY</th>
                        <th>CODE</th>
                        <th>CITY</th>
                        <th>PATH</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                        <th>DATE</th>
                    </tr>
                    </tfoot>
                    </table>
                    <div><span class="paginate">{{ $analytics->render() }}</span></div>
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
@extends('layouts/master')
@section('title', 'Receive help')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>All Users</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="index.html">Fakepop</a>
                </li>
               <!--  <li class="active">
                    <strong>Breadcrumb</strong>
                </li> -->
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
                        <th>ID</th>
                        <th>RECIPIENT </th>
                        <th>DONOR</th>
                        <th>DATE</th>
                        <th>PROOFS</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($transactions)
                    <?php $count = 0; ?>
                    @foreach ($transactions as $transaction)
                    <tr>
                       <td>{{ ++$count }}</td> 
                       <td class="clearfix">
                       <a href="{{ url('admin/user/profile', $transaction->collection->user->id) }}">
                        {{ $transaction->collection->user->name }}</a>
                        </td> 
                        <td> <a href="{{ url('admin/user/profile', $transaction->donation->user->id) }}">
                        {{ $transaction->donation->user->name }}</a>
                        </td> 
                       <td>{{ $transaction->updated_at }}</td> 
                       <td>
                           <a href="{{ url('view/gh/attachment', $transaction->id) }}" 
                                        class="label label-success"> View Attachment</a>
                       </td> 
                       <td>
                            @if($transaction->donation->user->isBlocked == 0)
                           <a href="{{ url('admin/block/donor/delete', $transaction->donation->user->id) }}"
                            class="btn btn-danger btn-sm">Block Donor</a>
                            @else
                                <a admin="{{ url('admin/delete/transaction'
                                , $transaction->id) }}"
                                class="btn btn-danger">Delete Transaction</a>
                            @endif
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
                        <th>RECIPIENT </th>
                        <th>DONOR</th>
                        <th>DATE</th>
                        <th>PROOFS</th>
                        <th>ACTION</th>
                    </tr>
                    </tfoot>
                    </table>
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
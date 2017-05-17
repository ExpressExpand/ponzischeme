@extends('layouts/master')
@section('title', 'Gh orders')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>GH ORDERS</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="">
                    <strong>Admin</strong>
                </li>
                <li class="active">
                    <strong>Gh orders</strong>
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
                                <span class="label label-info pull-right">Request</span>
                                <h5>PENDING WITHDRAWAL</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $pending_count }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Request</span>
                                <h5>CONFIRMED WITHDRAWAL</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $confirmed_count }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Request</span>
                                <h5>WITHDRAWALS</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $payout_count }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Amount</span>
                                <h5>REQUESTED AMOUNT</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ number_format($pending_amount) }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Amount</span>
                                <h5>PAYOUT AMOUNT CONFIRMED</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ number_format($confirmed_amount) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    @include('partials/_alert')
                                      
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME </th>
                        <th>AMOUNT</th>
                        <th>WITHDRAWAL TYPE</th>
                        <th>STATUS</th>
                        <th>DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($collections)
                    <?php $count = 0; ?>
                    @foreach ($collections as $collection)
                    @if($collection->user->hasRole('superadmin'))
                        <?php //continue; ?>
                    @endif
                    <tr>
                       <td>{{ ++$count }}</td> 
                       <td class="clearfix">
                       <a href="{{ url('admin/user/profile', $collection->user->id) }}"> 
                       {{ $collection->user->name }}</a>
                        </td> 
                       <td>{{ number_format($collection->amount) }}</td> 
                       <td>
                            {{ $collection->paymentType }}
                       </td> 
                       <td>{{ $collection->status }}</td> 
                       <td>{{ date('M d Y', strtotime($collection->created_at)) }}</td> 
                       <td>
                           <a href="admin/gh/transactions" class="btn btn-primary btn-sm">
                           View transaction</a>

                           @if($collection->status == ucfirst(App\DonationHelp::$SLIP_PENDING))
                           <a href="admin/gh/matching" class="btn btn-info btn-sm">
                           Match</a>
                           @endif
                            @if($collection->status == ucfirst(App\DonationHelp::$SLIP_CANCELLED))
                           <a href="admin/gh/cancel" class="btn btn-danger btn-sm">
                           Cancel</a>
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
                        <th>NAME </th>
                        <th>AMOUNT</th>
                        <th>PAYMENT TYPE</th>
                        <th>STATUS</th>
                        <th>DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                    </tfoot>
                    </table>
                    <div><span class="paginate">{{ $collections->render() }}</span></div>
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
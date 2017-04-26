@extends('layouts/master')
@section('title', 'Ph orders')

@section('content')       
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>PH ORDERS</h2>
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
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Orders</span>
                                <h5>PENDING</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $pending_count }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Orders</span>
                                <h5>ELAPSED</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $elapsed_count }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Orders</span>
                                <h5>CONFIRMED</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $confirmed_count }}</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Amount</span>
                                <h5>EXPECTED AMOUNT</h5>
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
                                <h5>GROWNING AMOUNT CONFIRMED</h5>
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
                        <th>PAYMENT TYPE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                        <th>DATE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($donations)
                    <?php $count = 0; ?>
                    @foreach ($donations as $donation)
                    @if($donation->user->hasRole('superadmin'))
                        <?php //continue; ?>
                    @endif
                    <tr>
                       <td>{{ ++$count }}</td> 
                       <td class="clearfix">
                       <a href="{{ url('admin/user/profile', $donation->user->id) }}"> 
                       {{ $donation->user->name }}</a>
                        </td> 
                       <td>{{ number_format($donation->amount) }}</td> 
                       <td>
                            {{ $donation->paymentType }}
                       </td> 
                       <td>{{ $donation->status }}</td> 
                       <td>
                           <a href="admin/ph/transactions" class="btn btn-primary btn-sm">
                           View transaction</a>
                       </td> 
                       <td>{{ date('M d, Y h:i:sa', strtotime($donation->created_at)) }}</td> 
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
                        <th>ACTIONS</th>
                        <th>DATE</th>
                    </tr>
                    </tfoot>
                    </table>
                    <div><span class="paginate">{{ $donations->render() }}</span></div>
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